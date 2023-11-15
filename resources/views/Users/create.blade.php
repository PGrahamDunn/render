<x-app-layout>
    <x-slot name="header">
        <x-header />
    </x-slot>
<section>
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg m-6 max-w-2xl mx-auto">

    <header>
        <h2 class="text-lg font-medium text-gray-900 ml-6">
            {{ __('New User') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 ml-6">
            {{ __("Input new user's information.") }}
        </p>
    </header>

    <form method="POST" action="{{ route('users.store') }}" class="m-6">
        @csrf
        <div class="max-w-xl space-y-6">

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required/>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

        </div>
        <div>
            <x-input-label for="badge" :value="__('Badge ID')" />
            <x-text-input id="badge" name="badge" type="text" class="mt-1 block w-full" required/>
            <x-input-error class="mt-2" :messages="$errors->get('badge')" />

        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required/>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

        </div>
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required/>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

        </div>
        </div>  
    </form>
    </div>  
    </section>

</x-app-layout>