<div class="bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-700 text-gray-100 max-w-4xl mx-auto">
    <div class="flex items-center justify-between pb-4 mb-6 border-b border-gray-700">
        <div>
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="ri-user-settings-line text-blue-400"></i>
                Perfil y Datos de Usuario
            </h2>
            <p class="text-sm text-gray-400 mt-1">Detalle del usuario en la plataforma</p>
        </div>
    </div>

    @if ($user)
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                <span class="text-xs text-gray-400 block mb-1">Nombre Completo</span>
                <span class="text-base font-semibold text-white">{{ $user->name }}</span>
            </div>

            <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                <span class="text-xs text-gray-400 block mb-1">Correo Electrónico</span>
                <span class="text-base font-semibold text-white">{{ $user->email }}</span>
            </div>

            <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                <span class="text-xs text-gray-400 block mb-1">Nivel</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-900/60 text-purple-200 border border-purple-700">
                    Nivel {{ $user->lvl ?? '1' }}
                </span>
            </div>

            <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                <span class="text-xs text-gray-400 block mb-1">Estado de la Cuenta</span>
                <span class="text-base font-semibold {{ $user->status ? 'text-green-400' : 'text-red-400' }}">
                    {{ $user->status ? 'Activo' : 'Inactivo' }}
                </span>
            </div>

            <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                <span class="text-xs text-gray-400 block mb-1">Dirección / Área</span>
                <span class="text-base font-semibold text-white">{{ $user->direction ?? 'Sin dirección' }}</span>
            </div>

            <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                <span class="text-xs text-gray-400 block mb-1">Puesto / Cargo</span>
                <span class="text-base font-semibold text-white">{{ $user->position ?? 'Sin cargo asignado' }}</span>
            </div>
        </div>
    @endif
</div>
