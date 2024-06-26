<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Auth::user()->receivedMessages()->with('sender')->latest()->get();
        return view('messages.index', compact('messages'));
    }

    public function send(Request $request, $name)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $recipient = User::where('name', $name)->firstOrFail();

        Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $recipient->id,
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
}
