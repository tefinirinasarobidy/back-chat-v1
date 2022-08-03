<?php
namespace App\Services;

use App\Events\Conversation as EventsConversation;
use App\Models\Conversation;
use App\Models\Message;
use Carbon\Carbon;

class ConversationService {
    public function allConversation($user)
    {
        $conversation = Conversation::with('last_message','talked')->whereHas('membres', function ($query) use($user){
            $query->where('customer_id',$user->id);
        })->orderBy('lastmessage','desc')->paginate(10);
        return $conversation;
    }

    public function sendMessage($request,$user)
    {
        if($request->conversation_id) {
            $message = $this->saveMessage($request->conversation_id,$request->message,$user);
        } else {
            $conversation = $this->createConversation($request,$user);
            $message = $this->saveMessage($conversation->id,$request->message,$user);
        }
        $message = $message->load(['conversation.membres.customer.active_profile.media','customer.active_profile.media']);
        EventsConversation::dispatch($message->conversation,$message);
        return $message;
    }

    public function saveMessage($conversation_id,$message,$user)
    {
        $message = Message::create([
            'message' => $message,
            'conversation_id' => $conversation_id,
            'customer_id' => $user->id,
        ]);
        $message->conversation()->update(['lastmessage' => Carbon::now()]);
        return $message;
    }

    public function createConversation($request,$user)
    {
        if (!$this->verifyConvExist($user,$request)) {
            $conversation = Conversation::create([
                'type' => 'private'
            ]);
            $this->addMembres($conversation,$user->id);
            $this->addMembres($conversation,$request->talked_id);
            return $conversation;
        }
        else {
            return $this->verifyConvExist($user,$request);
        }
    }
    public function verifyConvExist($user,$request)
    {
        $verify = Conversation::whereHas('membres', function ($q) use($user) {
            $q->where('customer_id',$user->id);
        })
        ->whereHas('membres', function ($q) use($request) {
            $q->where('customer_id',$request->talked_id);
        })->first();
        return $verify ? $verify : null ;
    }

    public function addMembres($conversation,$user)
    {
        $conversation->membres()->create([
            'customer_id' => $user,
            'conversation_id' => $conversation->id
        ]);
    }
}