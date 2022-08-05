<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function reseteTabele()
    {
        Conversation::orderBy('created_at','desc')->delete();
        return redirect()->back()->with('success', 'table conversation reset with succes');
    }
    public function index()
    {
        return view('backoffice.conversation.index');
    }
}
