<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // public function edit()
    // {
    //     return view('profile.edit');
    // }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'first_name' => 'nullable|string|max:255',
    //         'name' => 'required|string|max:255',
    //         'birth_date' => 'nullable|date',
    //         'email' => 'required|string|email|max:255',
    //         'address' => 'nullable|string|min:8',
    //         'zip_code' => 'nullable|string|max:10',
    //         'city' => 'nullable|string|max:255',
    //         'phone' => 'nullable|numeric|digits:10',
    //         'activity_type' => 'nullable|in:loisir,competition',
    //     ]);

    //     $user = Auth::user();
    //     $user->update($request->only(['first_name', 'name', 'birth_date', 'email', 'address', 'zip_code', 'city', 'phone', 'activity_type']));

    //     return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
    // }
    // public function show()
    // {
    //     $user = Auth::user();
    //     return view('profile', compact('user'));
    // }

    public function index()
    {
        $user = User::find(Auth::id());

        return view('laravel-examples.user-profile', compact('user'));
    }

    public function update(Request $request)
    {
        if (config('app.is_demo') && in_array(Auth::id(), [1])) {
            return back()->with('error', "You are in a demo version. You are not allowed to change the email for default users.");
        }

        $request->validate([
            'first_name' => 'required|min:3|max:44',
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'city' => 'max:255',
            'phone' => 'numeric|digits:10',
            'about' => 'max:255',
            'zip_code' => 'numeric|digits:5',
            'address' => 'nullable|string|min:8',            
            'birth_date' => 'nullable|date_format:d/m/Y',
            'activity_type' => ['nullable', Rule::in(['loisir', 'competition'])],
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
        ]);

        $user = User::find(Auth::id());

        $birth_date = $request->birth_date ? Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d') : null;

        $user->update([
            'first_name' => $request->first_name,
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'phone' => $request->phone,
            'about' => $request->about,
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'birth_date' => $birth_date,
            'activity_type' => $request->activity_type,

        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
}
