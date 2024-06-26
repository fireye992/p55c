<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    //fonction pour afficher les modification du profile authtifié
    public function index()
    {
        $authuser = User::find(Auth::id());

        return view('utilisateur.user-profile', compact('authuser'));
    }

    public function update(Request $request)
    {
           $request->validate([
            'first_name' => 'required|min:3|max:44',
            'name' => 'required|min:3|max:111',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'city' => 'max:55',
            'phone' => 'numeric|digits:10',
            'zip_code' => 'numeric|digits:5',
            'address' => 'nullable|string|min:8',            
            'birth_date' => 'nullable|date_format:d/m/Y',
            'activity_type' => ['nullable', Rule::in(['loisir', 'competition'])],
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // Max 2MB file
            'about' => 'nullable|string|max:500',
            'social_links' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
        ]);

        $authuser = User::find(Auth::id());

        $birth_date = $request->birth_date ? Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d') : null;

        $authuser->update([
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
            'social_links' => $request->social_links,

        ]);

        
    // if ($request->hasFile('photo')) {
    //     $user->updateProfilePhoto($request->file('photo'));
    // }
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('profile-photos', 'public');
        $authuser->profile_photo_path = $path;

        $authuser->about = $request->input('about');
        
        $authuser->save();
    
        // Log pour voir ce qui est enregistré
        // Log::info('Photo updated for user: ' . $user->id . ' with path: ' . $user->profile_photo_path);
    }
    
    // return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        return back()->with('success', 'Profile updated successfully.');
    }

   // fonction show pourles fallow et messages
    // public function show($name)
    // {
    //     $user = User::where('name', $name)->firstOrFail();
    //     $users = User::all(); // Ajouter cette ligne pour obtenir tous les utilisateurs
    //     return view('account-pages.profile', compact('user', 'users')); // Passer la variable $users à la vue
    // }

    public function show()
    {
        // Récupère l'utilisateur connecté
        $authuser = Auth::user();
        
        // Récupère tous les utilisateurs
        $users = User::all();
        
        // Passe les variables $user et $users à la vue
        return view('account-pages.profile', compact('authuser', 'users'));
    }

}