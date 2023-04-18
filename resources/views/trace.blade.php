<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="h-96 w-96 bg-white shadow-sm sm:rounded-lg">
            <label class="flex justify-center pt-6 font-semibold text-xl text-gray-800 leading-tight">{{ __('Trace your package') }}</label>
            <div class="align-bottom">
                <form class="px-4 pt-6" action="{{ route('search') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="search" id="default-search" name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ __('Enter your code...') }}" required>
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Search') }}</button>
                    </div>
                </form>
                @if ($status)
                <div class="mt-8">
                        <h2 class="font-semibold text-lg text-gray-800 leading-tight">{{ __('Search Results') }}</h2>
                        <p>{{ $status }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>