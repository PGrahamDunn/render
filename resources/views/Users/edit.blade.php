<x-app-layout>
    <x-slot name="header">
        <x-header />
    </x-slot>
    @livewire('users.Edit',['user' => $user, 'roles' => $roles])
</x-app-layout>