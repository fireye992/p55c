<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('utilisateur.users-management', compact('users'));
    }
    
    public function show($name)
    {
        $user = User::where('name', $name)->firstOrFail();
        return view('users.show', compact('user'));
    }

    
    public function updateActivity(Request $request)
    {
        $user = Auth::user();
        $user->last_activity = Carbon::now();
        $user->save();
    }
}
