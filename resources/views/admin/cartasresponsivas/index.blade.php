<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Gestión de Cartas Responsivas') }}
        </h2>
    </x-slot>

    <div class="py-4">
        @livewire('admin.cartasresponsivas.index')
    </div>
</x-app-layout>
