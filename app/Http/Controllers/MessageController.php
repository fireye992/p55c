<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Auth::user()->receivedMessages()->with('sender')->latest()->get();
        return view('messages.index', compact('messages'));
    }

    public function send(Request $request, $userId)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $userId,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
