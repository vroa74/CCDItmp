<div class="bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-700 text-gray-100 max-w-4xl mx-auto">
    <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-700">
        <div>
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="ri-edit-line text-blue-400"></i>
                Editar Reporte #{{ $reporteId }}
            </h2>
            <p class="text-sm text-gray-400 mt-1">Modificación de parámetros del reporte</p>
        </div>
        <a href="{{ route('admin.reportes.index') }}" class="text-gray-400 hover:text-white transition-colors">
            <x-lucide name="x" class="w-6 h-6" />
        </a>
    </div>

    <form wire:submit.prevent="update" class="space-y-6">
        <div>
            <label for="titulo" class="block text-sm font-medium text-gray-300 mb-2">Título del Reporte *</label>
            <input wire:model="titulo" type="text" id="titulo" class="w-full px-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Ingrese el título">
            @error('titulo') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="tipo" class="block text-sm font-medium text-gray-300 mb-2">Tipo de Reporte *</label>
            <select wire:model="tipo" id="tipo" class="w-full px-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 text-sm">
                <option value="general">General</option>
                <option value="servicios">Servicios</option>
                <option value="inventario">Inventario</option>
                <option value="usuarios">Usuarios</option>
            </select>
            @error('tipo') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-300 mb-2">Descripción</label>
            <textarea wire:model="descripcion" id="descripcion" rows="4" class="w-full px-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Detalles u observaciones del reporte"></textarea>
            @error('descripcion') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-700">
            <a href="{{ route('admin.reportes.index') }}" class="px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-lg text-sm font-medium transition-colors">
                Cancelar
            </a>
            <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                <i class="ri-save-line"></i>
                Actualizar Reporte
            </button>
        </div>
    </form>
</div>
