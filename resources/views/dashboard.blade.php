<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dusk="dashboard">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <livewire:welcomemessage />
</x-app-layout>
