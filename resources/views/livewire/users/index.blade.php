<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="flex items-center justify-between mt-1">
                <div class="max-w-lg w-full lg:max-w-xs">
                    <label for="search" class="sr-only">Search</label>
                    <div class="flex space-x-1">
                        <div class="left-0 p-2 flex items-center pointer-events-none border border-gray-300 rounded-md bg-white">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <x-text-input wire:model.live="search" wire:keydown="resetsearch" id="search" name="search" type="search" class=" block w-full" placeholder="Search" />
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <x-button-main  wire:click="update_users">Update users</x-button-main>
                    <a href="{{ route('users.create') }}">
                        <x-button-main>Add User</x-button-main>
                    </a>
                </div>
            </div>

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Badge ID
                            </th>
                            <th class="px-6 py-3 text-left bg-gray-50">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('name')" class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</button>
                                    @if ($sortField != 'name')
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                    @elseif ($sortAsc)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    @endif
                                </div>
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider hidden xl:table-cell">
                                Email
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Roles
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                        <tr wire:key="{{ $user->id }}">
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="text-sm leading-5 text-gray-900">{{ $user->badge_id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="text-sm leading-5 text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap hidden xl:table-cell">
                                <div class="text-sm leading-5 text-gray-900 truncate">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                @foreach ($user->roles as $role)
                                @if ($loop->iteration > 1)
                                <span class="mx-1">{{ __('|') }}</span>
                                @endif
                                <span class="text-sm leading-5 text-gray-900">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="px-6 py-2 whitespace-no-wrap">
                                <div class="text-sm leading-5 text-gray-900 truncate flex space-x-4 items-center">
                                    <a href="users/{{ $user->id }}/edit">
                                        <x-actions.edit />
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    <div class="h-96"></div>
</div>