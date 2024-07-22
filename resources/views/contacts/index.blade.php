<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <input type="text" 
                name="username" 
                placeholder="{{ __('Enter Contact Name') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{ old('username') }}"
            />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
            <input type="email" 
                name="email" 
                placeholder="{{ __('Enter Contact Email') }}"
                class="mt-4 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{ old('email') }}"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Add Contact') }}</x-primary-button>
        </form>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($contacts as $contact)
                <div class="p-6 flex space-x-2 mt-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $contact->username }}</span>
                                <small class="ml-2 text-sm text-gray-600 text-red-400">{{ $contact->email }}</small>
                            </div>
                            <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('contacts.edit', $contact)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('contacts.destroy', $contact) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('contacts.destroy', $contact)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>

                                    </x-slot>
                                </x-dropdown>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>