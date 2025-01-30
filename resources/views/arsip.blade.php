<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="flex items-center">
                {{ __('Arsip') }} <x-heroicon-m-chevron-right class="w-4 h-4 mr-1" /> {{ __('Daftar Arsip Surat') }}
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <livewire:arsip-surat />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>