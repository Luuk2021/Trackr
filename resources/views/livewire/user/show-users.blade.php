<div class="max-w-4xl mx-auto mt-5">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 dusk="users" class="text-xl font-semibold text-gray-900">{{ __('Users') }}</h1>
                <p class="mt-2 text-sm text-gray-700">{{ __('A list of all the users') }}</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a id="add-user" href="/user/add" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    {{ __('Add user') }}
                </a>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table id="table" class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6">
                                        <div wire:click="sortBy('name')" scope="col" class="cursor-pointer underline">
                                            {{ __('Name') }}
                                        </div>
                                        <div class="pb-2">
                                            <input class="text rounded pl-1 border border-grey-400" wire:model="searchName" placeholder="{{ __('Search') }}..."></input>
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
                                    <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">{{ __('Edit') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">

                                @foreach($users as $user)
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $user->name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $user->email }}
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a id="edit" href="/user/edit/{{ $user->id }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                                        <a id="delete" href="#" onclick="confirm('Are you sure you want to remove the user') || event.stopImmediatePropagation()" wire:click="delete({{ $user->id }})" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bg-gray-50 pl-3 pr-3 pb-1 pt-1 border-t-[1px] border-gray-300">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
