<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-100">Editar edificio</h2></x-slot>
    <div class="py-6"><div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">@include('admin.edificios.form', ['action' => route('edificios.update', $edificio), 'method' => 'PUT', 'title' => 'Editar edificio'])</div></div>
</x-app-layout>