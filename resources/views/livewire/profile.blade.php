{{-- <div class="px-5 py-4 container">
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
            <div class="col-lg-9 col-12">
                <div class="card card-body" id="profile">
                    <img src="../../../assets/img/header-orange-purple.jpg" alt="pattern-lines"
                        class="top-0 rounded-2 position-absolute start-0 w-100 h-100">

                    <div class="row z-index-2 justify-content-center align-items-center">
                        <div class="col-sm-auto col-4">
                            <div class="avatar avatar-xl position-relative">
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Profile Photo"
                                    class="w-100 h-100 object-fit-cover border-radius-lg shadow-sm"
                                    id="preview">
                            </div>
                        </div>
                        <div class="col-sm-auto col-8 my-auto">
                            <div class="h-100">
                                <h5 class="mb-1 font-weight-bolder">
                                    {{ auth()->user()->name }}
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    {{ auth()->user()->first_name }}
                                </p>
                                <p class="mb-0 font-weight-bold text-sm">
                                    @if (auth()->user()->is_admin)
                                        <span style="color: darkred;">Administrateur</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                            <div class="form-check form-switch ms-2">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23"
                                    checked onchange="visible()">
                            </div>
                            <label class="text-white form-check-label mb-0">
                                <small id="profileVisibility">
                                    Switch to invisible
                                </small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert" id="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert" id="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-5 row justify-content-center">
            <div class="col-lg-9 col-12">
                <div class="card " id="basic-info">
                    <div class="card-header">
                        <h5>Basic Info</h5>
                    </div>
                    <div class="pt-0 card-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="first_name">Prénom</label>
                                <input type="text" wire:model="first_name" id="first_name" class="form-control">
                                @error('first_name') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6">
                                <label for="name">Nom</label>
                                <input type="text" wire:model="name" id="name" class="form-control">
                                @error('name') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="email">Email</label>
                                <input type="email" wire:model="email" id="email" class="form-control">
                                @error('email') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6">
                                <label for="activity_type" class="block font-medium text-sm text-gray-700">Activité</label>
                                <select id="activity_type" wire:model="activity_type" class="form-control block mt-1 w-full">
                                    <option value="loisir">{{ __('Loisir') }}</option>
                                    <option value="competition">{{ __('Competition') }}</option>
                                </select>
                                @error('activity_type') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="zip_code">Code postal</label>
                                <input type="text" wire:model="zip_code" id="zip_code" placeholder="0733456987"
                                    class="form-control">
                                @error('zip_code') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6">
                                <label for="city">Ville</label>
                                <input type="text" wire:model="city" id="city" placeholder="Strasbourg, France"
                                    class="form-control">
                                @error('city') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="birth_date">Date de naissance</label>
                                <input type="text" wire:model="birth_date" id="birth_date" placeholder="dd/mm/yyyy"
                                    class="form-control">
                                @error('birth_date') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6">
                                <label for="phone">Téléphone</label>
                                <input type="text" wire:model="phone" id="phone" placeholder="0733456987"
                                    class="form-control">
                                @error('phone') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" wire:model="photo" class="form-control" id="photo">
                            @error('photo') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="row p-2">
                            <label for="about">À propos de moi</label>
                            <textarea wire:model="about" id="about" rows="5" class="form-control"></textarea>
                            @error('about') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Enregistrer
                            les modifications</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> --}}

 <div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div>
        <h3 class="mb-0 font-weight-bold">
            {{ $name ?? '' }}
        </h3>
        <!-- Ajoute d'autres champs si nécessaire -->
    </div>
    


    <form wire:submit.prevent="save">
        <div>
            <x-label for="first_name" :value="__('First Name')" />
            <x-input id="first_name" class="block mt-1 w-full" type="text" wire:model="first_name" />
        </div>

        <div>
            <x-label for="name" :value="__('Name')" />
            <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" required />
        </div>

        <div>
            <x-label for="birth_date" :value="__('Birth Date')" />
            <x-input id="birth_date" class="block mt-1 w-full" type="date" wire:model="birth_date" />
        </div>

        <div>
            <x-label for="email" :value="__('Email')" />
            <x-input id="email" class="block mt-1 w-full" type="email" wire:model="email" required />
        </div>

        <div>
            <x-label for="address" :value="__('Address')" />
            <x-input id="address" class="block mt-1 w-full" type="text" wire:model="address" />
        </div>

        <div>
            <x-label for="zip_code" :value="__('Zip Code')" />
            <x-input id="zip_code" class="block mt-1 w-full" type="text" wire:model="zip_code" />
        </div>

        <div>
            <x-label for="city" :value="__('City')" />
            <x-input id="city" class="block mt-1 w-full" type="text" wire:model="city" />
        </div>

        <div>
            <x-label for="phone" :value="__('Phone')" />
            <x-input id="phone" class="block mt-1 w-full" type="text" wire:model="phone" />
        </div>

        <div>
            <x-label for="activity_type" :value="__('Activity Type')" />
            <select id="activity_type" wire:model="activity_type" class="block mt-1 w-full">
                <option value="loisir">{{ __('Loisir') }}</option>
                <option value="competition">{{ __('Competition') }}</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Update Profile') }}
            </x-button>
        </div>
    </form>
</div>
