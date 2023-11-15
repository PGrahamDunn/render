<section>
    <div class="p-4 sm:p-4 bg-white shadow sm:rounded-lg m-6 max-w-5xl mx-auto">

        <header>
            <h2 class="text-lg font-medium text-gray-900 ml-6">
                {{ __('Edit User') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 ml-6">
                {{ __("Update user's information.") }}
            </p>
        </header>

        <form method="POST" action="{{ route('users.update',$user->id) }}" class="m-6">
            @csrf
            @method('PUT')
            <div class="flex space-x-8">

                <div class="max-w-xl space-y-6 b w-1/2">

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" value="{{ $user->name }}" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    </div>
                    <div>
                        <x-input-label for="badge" :value="__('Badge ID')" />
                        <x-text-input id="badge" name="badge" type="text" value="{{ $user->badge_id }}" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('badge')" />

                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" value="{{ $user->email }}" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    </div>
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                </div>
                <div>
                    <span class="text-sm">Roles</span>
                    @foreach($roles as $role)
                    <div class="border py-2 px-3 w-full rounded-md shadow-sm mb-6 border-gray-300">
                        <div class="flex space-x-8 items-center">
                            <input id="{{ $role->name }}" type="checkbox" {{ $user->containsRole($role->name) ? 'checked': '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="{{ $role->name }}">
                            <div class="w-8">
                                <label for="{{ $role->name }}">{{ $role->name }}</label>
                            </div>
                            <span class="text-sm">{{ $role->description }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-4 mt-8">
                <x-primary-button>{{ __('Update') }}</x-primary-button>

            </div>
        </form>
    </div>
</section>