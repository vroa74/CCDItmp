<div class="bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-700 text-gray-100">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="ri-book-2-line text-blue-400"></i>
                Catálogo de Materias
            </h2>
            <p class="text-sm text-gray-400 mt-1">Gestión y administración del catálogo del sistema</p>
        </div>
        <div class="w-full sm:w-auto">
            <input 
                wire:model.live="search" 
                type="text" 
                placeholder="Buscar en catálogo..."
                class="w-full sm:w-64 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 text-sm"
            >
        </div>
    </div>

    <div class="bg-gray-900/50 rounded-xl border border-gray-700/60 p-8 text-center text-gray-400">
        <i class="ri-folder-open-line text-4xl mb-3 text-gray-500 inline-block"></i>
        <p class="text-base text-gray-300 font-medium">Módulo de Catálogo</p>
        <p class="text-sm text-gray-500 mt-1">Sección segmentada lista para la gestión de materias y catálogo general.</p>
    </div>
</div>
