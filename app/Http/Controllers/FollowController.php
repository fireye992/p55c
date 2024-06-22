<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        Auth::user()->following()->create(['user_id' => $user->id]);
        return redirect()->back()->with('success', 'You are now following ' . $user->name);
    }

    public function unfollow($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        Auth::user()->following()->where('user_id', $user->id)->delete();
        return redirect()->back()->with('success', 'You have unfollowed ' . $user->name);
    }
}
