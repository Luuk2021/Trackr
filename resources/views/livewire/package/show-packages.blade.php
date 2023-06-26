<div>
    <div class="max-w-4xl mx-auto mt-5">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">{{ __('Packages') }}</h1>
                    <p class="mt-2 text-sm text-gray-700">{{ __('A list of all the packages') }}.</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a id="add-package" href="/package/add" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                        {{ __('Add package') }}
                    </a>
                    <form wire:submit.prevent="import">
                        <input id="file" type="file" wire:model="file">
                        <button dusk="import" type="submit" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">{{ __('Import') }}</button>
                    </form>
                    <a id="download-bulk" href="#" wire:click="generateSelectedPDFs()" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">{{ __('Download Selected') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 flex flex-col px-20">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table id="table" class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6">
                                    <div wire:click="sortBy('lastname')" scope="col" class="cursor-pointer underline">
                                        {{ __('Name') }}
                                    </div>
                                    <div class="pb-2">
                                        <input class="text rounded pl-1 border border-grey-400" wire:model="searchLastname" placeholder="{{ __('Search') }}..."></input>
                                    </div>
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    <div wire:click="sortBy('email')" scope="col" class="cursor-pointer underline">
                                        {{ __('Email') }}
                                    </div>
                                    <div class="pb-2">
                                        <input class="text rounded pl-1 border border-grey-400" wire:model="searchEmail" placeholder="{{ __('Search') }}..."></input>
                                    </div>
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    <div wire:click="sortBy('shops.name')" scope="col" class="cursor-pointer underline">
                                        {{ __('Shop') }}
                                    </div>
                                    <div class="pb-2">
                                        <input class="text rounded pl-1 border border-grey-400" wire:model="searchShopname" placeholder="{{ __('Search') }}..."></input>
                                    </div>
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    <div wire:click="sortBy('status')" scope="col" class="cursor-pointer underline">
                                        {{ __('Status') }}
                                    </div>
                                    <div class="pb-2">
                                        <input class="text rounded pl-1 border border-grey-400" wire:model="searchStatus" placeholder="{{ __('Search') }}..."></input>
                                    </div>
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    <div wire:click="sortBy('streetname')" scope="col" class="cursor-pointer underline">
                                        {{ __('Address') }}
                                    </div>
                                    <div class="pb-2">
                                        <input class="text rounded pl-1 border border-grey-400" wire:model="searchStreetname" placeholder="{{ __('Search') }}..."></input>
                                    </div>
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    <div wire:click="sortBy('zipcode')" scope="col" class="cursor-pointer underline">
                                        {{ __('Zip code') }}
                                    </div>
                                    <div class="pb-2">
                                        <input class="text rounded pl-1 border border-grey-400" wire:model="searchZipcode" placeholder="{{ __('Search') }}..."></input>
                                    </div>
                                </th>
                                <th class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    <div wire:click="sortBy('city')" scope="col" class="cursor-pointer underline">
                                        {{ __('City') }}
                                    </div>
                                    <div class="pb-2">
                                        <input class="text rounded pl-1 border border-grey-400" wire:model="searchCity" placeholder="{{ __('Search') }}..."></input>
                                    </div>
                                </th>
                                <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-6">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">

                            @foreach($packages as $package)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ $package->lastname . ', ' . $package->firstname }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $package->email }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $package->shop->name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $package->status }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $package->streetname . ' ' . $package->housenumber }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $package->zipcode }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $package->city }}
                                </td>

                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <input id="checkbox{{ $package->id }}" type="checkbox" wire:model="selectedPackages" value="{{ $package->id }}">
                                    <a id="download" href="#" wire:click="generatePDF([{{ $package->id }}])" class="text-indigo-600 hover:text-indigo-900">{{ __('Download') }}</a>
                                    <a id="delete" href="#" onclick="confirm('Are you sure you want to remove the package') || event.stopImmediatePropagation()" wire:click="delete({{ $package->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="bg-gray-50 pl-3 pr-3 pb-1 pt-1 border-t-[1px] border-gray-300">
                        {{ $packages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
