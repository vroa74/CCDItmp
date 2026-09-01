<x-guest-layout>
	<x-authentication-card>
		<x-slot name="logo">
			<x-authentication-card-logo />
		</x-slot>

		<div class="text-center">
			<p class="text-sm font-semibold text-indigo-400">Error 403</p>
			<h1 class="mt-2 text-xl font-semibold text-white">Acceso restringido</h1>
			<p class="mt-3 text-sm leading-6 text-gray-400">
				{{ $exception->getMessage() ?: 'No cuentas con los permisos necesarios para acceder a esta sección.' }}
			</p>
		</div>

		<div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-center">
			@auth
				<a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800">
					Volver al dashboard
				</a>

				<form method="POST" action="{{ route('logout') }}">
					@csrf
					<button type="submit" class="w-full rounded-md border border-gray-600 px-4 py-2 text-sm font-semibold text-gray-300 transition hover:border-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800">
						Cerrar sesión
					</button>
				</form>
			@else
				<a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800">
					Iniciar sesión
				</a>
			@endauth
		</div>
	</x-authentication-card>
</x-guest-layout>
