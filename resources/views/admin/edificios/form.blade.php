<div class="rounded-2xl border border-gray-700 bg-gray-800 p-6 shadow-xl">
    <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
    <form method="POST" action="{{ $action }}" class="mt-5 space-y-4">
        @csrf
        @if ($method !== 'POST') @method($method) @endif
        <div><label for="nombre" class="mb-1 block text-sm text-gray-300">Nombre</label><input id="nombre" name="nombre" value="{{ old('nombre', $edificio->nombre ?? '') }}" maxlength="100" required class="w-full rounded-lg border-gray-700 bg-gray-900 text-white focus:border-blue-500 focus:ring-blue-500">@error('nombre')<span class="text-sm text-red-400">{{ $message }}</span>@enderror</div>
        <div><label for="direccion" class="mb-1 block text-sm text-gray-300">Dirección</label><textarea id="direccion" name="direccion" rows="3" class="w-full rounded-lg border-gray-700 bg-gray-900 text-white focus:border-blue-500 focus:ring-blue-500">{{ old('direccion', $edificio->direccion ?? '') }}</textarea>@error('direccion')<span class="text-sm text-red-400">{{ $message }}</span>@enderror</div>
        <div class="flex justify-end gap-3"><a href="{{ route('edificios.index') }}" class="rounded-lg border border-gray-600 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Cancelar</a><button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Guardar</button></div>
    </form>
</div>