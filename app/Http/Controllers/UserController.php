<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
