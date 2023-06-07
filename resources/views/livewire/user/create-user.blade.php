<div class="max-w-4xl mx-auto mt-5">
    <div class="px-4 sm:px-6 lg:px-8">
        <form wire:submit.prevent="save">

            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Name') }}</label>
                <input type="text" wire:model="users.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Enter name') }}..." required="">
                @error('users.name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Email') }}</label>
                <input type="email" wire:model="users.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Enter email') }}..." required="">
                @error('users.email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Password') }}</label>
                <input type="password" wire:model="users.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Enter password') }}..." required="">
                @error('users.password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="shops" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Shops') }}</label>
                <div class="pb-2">
                    <input class="text rounded pl-1 border border-grey-400" wire:model="searchName" placeholder="{{ __('Search') }}..."></input>
                </div>
                <select dusk="select-shop" wire:model="selectedShopIds" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach($allShops as $shop)
                    <option @if(!$shopsToShow->contains($shop->id)) :
                        hidden
                        @endif
                        value="{{ $shop->id }}">{{ $shop->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Role') }}</label>
                <input type="text" wire:model="users.role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Enter role') }}..." required="">
                @error('users.role') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-start space-x-4">
                <a href="/user" class="text-gray-900  font-medium  text-sm ">{{ __('Back') }}</a>
                <button dusk="save" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">
                    {{ __('Save') }}
                </button>
            </div>

        </form>

    </div>
</div>
