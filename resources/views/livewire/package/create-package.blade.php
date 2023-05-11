<div class="max-w-4xl mx-auto mt-5">
    <div class="px-4 sm:px-6 lg:px-8">
        <form wire:submit.prevent="save">

            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Email') }}</label>
                <input type="email" wire:model="package.email" placeholder="{{ __('Enter email') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('package.email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900">{{ __('First name') }}</label>
                <input type="text" wire:model="package.firstname" placeholder="{{ __('Enter first name') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('package.firstname') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Last name') }}</label>
                <input type="text" wire:model="package.lastname" placeholder="{{ __('Enter last name') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('package.lastname') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="streetname" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Street name') }}</label>
                <input type="text" wire:model="package.streetname" placeholder="{{ __('Enter street name') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('package.streetname') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="housenumber" class="block mb-2 text-sm font-medium text-gray-900">{{ __('House number') }}</label>
                <input type="text" wire:model="package.housenumber" placeholder="{{ __('Enter house number') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('package.housenumber') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="zipcode" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Zip code') }}</label>
                <input type="text" wire:model="package.zipcode" placeholder="{{ __('Enter zip code') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('package.zipcode') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">{{ __('City') }}</label>
                <input type="text" wire:model="package.city" placeholder="{{ __('Enter city') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('package.city') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="shops" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Shops') }}</label>
                <div class="pb-2">
                    <input class="text rounded pl-1 border border-grey-400" wire:model="searchName" placeholder="{{ __('Search') }}..."></input>
                </div>
                <select wire:model="package.shop_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach($allShops as $shop)
                    <option @if(!$shopsToShow->contains($shop->id)) :
                        hidden
                        @endif
                        value="{{ $shop->id }}">{{ $shop->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-start space-x-4">
                <a href="/package" class="text-gray-900  font-medium  text-sm ">{{ __('Back') }}</a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">
                    {{ __('Save') }}
                </button>
            </div>

        </form>

    </div>
</div>
