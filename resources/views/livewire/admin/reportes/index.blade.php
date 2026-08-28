<div class="space-y-6">
    <!-- Información del Usuario Autenticado (Nivel, Estado, Email, Nombre) -->
    @if ($currentUser)
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 border border-gray-700/80 rounded-2xl p-6 shadow-xl text-gray-100">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-700/60">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-blue-600/30 border border-blue-500/50 flex items-center justify-center text-blue-400">
                        <i class="ri-user-star-line text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Datos de Sesión de Usuario</h3>
                        <p class="text-xs text-gray-400">Información del usuario actual en el sistema</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $currentUser->status ? 'bg-green-900/60 text-green-300 border border-green-700' : 'bg-red-900/60 text-red-300 border border-red-700' }}">
                    <span class="w-2 h-2 rounded-full mr-2 {{ $currentUser->status ? 'bg-green-400' : 'bg-red-400' }}"></span>
                    {{ $currentUser->status ? 'Activo' : 'Inactivo' }}
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-gray-800/80 rounded-xl p-4 border border-gray-700">
                    <span class="text-xs text-gray-400 block mb-1">Nombre</span>
                    <span class="text-sm font-semibold text-white truncate block">{{ $currentUser->name ?? 'N/A' }}</span>
                </div>
                <div class="bg-gray-800/80 rounded-xl p-4 border border-gray-700">
                    <span class="text-xs text-gray-400 block mb-1">Correo Electrónico</span>
                    <span class="text-sm font-semibold text-white truncate block">{{ $currentUser->email ?? 'N/A' }}</span>
                </div>
                <div class="bg-gray-800/80 rounded-xl p-4 border border-gray-700">
                    <span class="text-xs text-gray-400 block mb-1">Nivel</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-900/60 text-purple-200 border border-purple-700">
                        Nivel {{ $currentUser->lvl ?? '1' }}
                    </span>
                </div>
                <div class="bg-gray-800/80 rounded-xl p-4 border border-gray-700">
                    <span class="text-xs text-gray-400 block mb-1">Estado</span>
                    <span class="text-sm font-semibold {{ $currentUser->status ? 'text-green-400' : 'text-red-400' }}">
                        {{ $currentUser->status ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
            </div>
        </div>
    @endif

    <!-- Sección de Reportes -->
    <div class="bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-700 text-gray-100">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <i class="ri-file-chart-line text-blue-400"></i>
                    Administración de Reportes
                </h2>
                <p class="text-sm text-gray-400 mt-1">Generación y administración de reportes del sistema</p>
            </div>
            <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                <a href="{{ route('admin.reportes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                    <i class="ri-add-line"></i>
                    Nuevo Reporte
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('servicios.index') }}" class="group rounded-xl border border-gray-700 bg-gray-900/40 p-4 hover:border-blue-500/60 transition-colors">
                <div class="flex items-center gap-3">
                    <i class="ri-service-fill text-2xl text-blue-400"></i>
                    <div>
                        <p class="font-medium text-white">Reportes de Servicios</p>
                        <p class="text-xs text-gray-400">PDFs y reportes individuales/detalles</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('inventario.index') }}" class="group rounded-xl border border-gray-700 bg-gray-900/40 p-4 hover:border-emerald-500/60 transition-colors">
                <div class="flex items-center gap-3">
                    <i class="ri-list-settings-line text-2xl text-emerald-400"></i>
                    <div>
                        <p class="font-medium text-white">Reportes de Inventario</p>
                        <p class="text-xs text-gray-400">Exportación CSV y HTML</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('cartasresponsivas.index') }}" class="group rounded-xl border border-gray-700 bg-gray-900/40 p-4 hover:border-amber-500/60 transition-colors">
                <div class="flex items-center gap-3">
                    <i class="ri-file-list-3-line text-2xl text-amber-400"></i>
                    <div>
                        <p class="font-medium text-white">Cartas Responsivas</p>
                        <p class="text-xs text-gray-400">Emisión y consulta de cartas</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
