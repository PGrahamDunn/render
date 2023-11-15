<x-app-layout>
    <x-slot name="header">
        <x-header />
    </x-slot>
    @livewire('users.EditUser',['user' => $user, 'roles' => $roles])
</x-app-layout>