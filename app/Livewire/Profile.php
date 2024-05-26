<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Profile extends Component
{
    public $first_name;
    public $name;
    public $birth_date;
    public $email;
    public $address;
    public $zip_code;
    public $city;
    public $phone;
    public $activity_type;

    protected $rules = [
        'first_name' => 'nullable|string|max:255',
        'name' => 'required|string|max:255',
        'birth_date' => 'nullable|date',
        'email' => 'required|string|email|max:255',
        'address' => 'nullable|string|min:8',
        'zip_code' => 'numeric|digits|max:10',
        'city' => 'nullable|string|max:255',
        'phone' => 'nullable|string|min:10',
        'activity_type' => 'nullable|in:loisir,competition',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->first_name = $user->first_name;
        $this->name = $user->name;
        $this->birth_date = $user->birth_date;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->zip_code = $user->zip_code;
        $this->city = $user->city;
        $this->phone = $user->phone;
        $this->activity_type = $user->activity_type;
    }

    public function save()
    {
        $this->validate();

        $user = Auth::user();
        $user->update([
            'first_name' => $this->first_name,
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'email' => $this->email,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'city' => $this->city,
            'phone' => $this->phone,
            'activity_type' => $this->activity_type,
        ]);

        session()->flash('status', 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
