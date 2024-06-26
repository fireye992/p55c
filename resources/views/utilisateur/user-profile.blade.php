<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100  ">
        <x-app.navbar />
        <div class="px-5 py-4 container"> <!-- Changez ici de 'container-fluid' à 'container' -->
            <form action={{ route('users.update') }} method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                                            {{  auth()->user()->first_name }}
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
                    <div class="col-lg-9 col-12 ">
                        <div class="card " id="basic-info">
                            <div class="card-header">
                                <h5>Basic Info</h5>
                            </div>
                            <div class="pt-0 card-body">

                                <div class="row">
                                    <div class="col-6">
                                        <label for="first_name">Prénom</label>
                                        <input type="text" name="first_name" id="first_name"
                                            value="{{ old('first_name', auth()->user()->first_name) }}" class="form-control">
                                        @error('first_name')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', auth()->user()->name) }}" class="form-control">
                                        @error('name')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', auth()->user()->email) }}" class="form-control">
                                        @error('email')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="activity_type" class="block font-medium text-sm text-gray-700">Activité</label>
                                        <select id="activity_type" name="activity_type" class="form-control block mt-1 w-full">
                                            <option value="loisir" {{ old('activity_type', auth()->user()->activity_type) == 'loisir' ? 'selected' : '' }}>
                                                {{ __('Loisir') }}
                                            </option>
                                            <option value="competition" {{ old('activity_type', auth()->user()->activity_type) == 'competition' ? 'selected' : '' }}>
                                                {{ __('Competition') }}
                                            </option>
                                        </select>
                                        @error('activity_type')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="zip_code">zip_code</label>
                                        <input type="text" name="zip_code" id="zip_code" placeholder="0733456987"
                                            value="{{ old('zip_code', auth()->user()->zip_code) }}" class="form-control">
                                        @error('zip_code')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="location">Location</label>
                                        <input type="text" name="city" id="city"
                                            placeholder="Strasbourg, France"
                                            value="{{ old('city', auth()->user()->city) }}"
                                            class="form-control">
                                        @error('location')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="birth_date">Date de naissance</label>
                                        <input type="text" name="birth_date" id="birth_date"
                                               placeholder="Jour/mois/année"
                                               value="{{ old('birth_date', auth()->user()->birth_date) }}"
                                               class="form-control">
                                        @error('birth_date')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" placeholder="0733456987"
                                            value="{{ old('phone', auth()->user()->phone) }}" class="form-control">
                                        @error('phone')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <label for="photo">Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                    @error('photo')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="social_links">Social Links (comma separated)</label>
                                    <input type="text" name="social_links" id="social_links" 
                                    value="{{ old('social_links', implode(',', auth()->user()->social_links)) }}" class="form-control">
                                    @error('social_links')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                     
                                <div class="row p-2">
                                    <label for="about">About me</label>
                                    <textarea name="about" id="about" rows="5" class="form-control">{{ old('about', auth()->user()->about) }}</textarea>
                                    @error('about')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                               
                                
                                <button type="submit" class="mt-6 mb-0 btn btn-white btn-sm float-end">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <x-app.footer />
        </div>
    </main>

</x-app-layout>
