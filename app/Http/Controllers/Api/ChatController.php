<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Services\ConversationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    protected $conversationService;
    public function __construct() {
        $this->conversationService = new ConversationService;
    }

    public function index()
    {
        $conversation = $this->conversationService->allConversation(Auth::user());
        return response()->json($conversation);
    }

    public function sendMessage(Request $request)
    {
        $message = $this->conversationService->sendMessage($request,Auth::user());
        return response()->json($message);
    }

    public function showConversation(Conversation $conversation)
    {
        $messages = $conversation->message()->with(['conversation.membres.customer.active_profile.media','customer.active_profile.media'])->paginate(10);
        return response()->json($messages);
    }
}
