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
