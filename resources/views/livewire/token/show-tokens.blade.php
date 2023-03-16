<div>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Tokens') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Check and create your tokens.') }}
        </p>
    </header>

    <div class="flex items-center gap-4">
        <label class="block font-medium text-sm text-gray-700">
            {{ __('Token name') }}
        </label>

        <form wire:submit.prevent="create">
            <input type="text" wire:model="name"
                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
            @error('name') <span class="error">{{ $message }}</span> @enderror
            <div class=pt-4>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Create token
                </button>
            </div>
        </form>
        <h1>
            {{ $token }}
        </h1>
    </div>

    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                {{ __('Name') }}
                            </th>
                            <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">{{ __('Delete') }}</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">

                        @foreach($tokens as $viewableToken)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ $viewableToken->name }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#"
                                       onclick="confirm('Are you sure you want to remove this token?') || event.stopImmediatePropagation()"
                                       wire:click="delete({{ $viewableToken->id }})"
                                       class="text-red-600 hover:text-red-900">{{ __('Delete') }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
