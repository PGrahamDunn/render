<x-app-layout>
    <x-slot name="header">
        <x-header />
    </x-slot>
    <div class="p-2 m-2">
    @livewire('users.ShowUsers')
    </div>
</x-app-layout>