<div class="max-w-4xl mx-auto mt-5">
    <div class="px-4 sm:px-6 lg:px-8">
        <form wire:submit.prevent="save">

            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Name') }}</label>
                <input dusk="name" type="text" wire:model="shop.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ __('Enter name') }}..." required="">
                @error('shop.name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="streetname" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Street name') }}</label>
                <input type="text" wire:model="shop.streetname" placeholder="{{ __('Enter street name') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('shop.streetname') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="housenumber" class="block mb-2 text-sm font-medium text-gray-900">{{ __('House number') }}</label>
                <input type="text" wire:model="shop.housenumber" placeholder="{{ __('Enter house number') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('shop.housenumber') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="zipcode" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Zip code') }}</label>
                <input type="text" wire:model="shop.zipcode" placeholder="{{ __('Enter zip code') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('shop.zipcode') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">{{ __('City') }}</label>
                <input type="text" wire:model="shop.city" placeholder="{{ __('Enter city') }}..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                @error('shop.city') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-start space-x-4">
                <a href="/shop" class="text-gray-900  font-medium  text-sm ">{{ __('Back') }}</a>
                <button dusk="save" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">
                    {{ __('Save') }}
                </button>
            </div>

        </form>

    </div>
</div>
