<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight flex items-center gap-2">
            <i class="ri-wifi-fill"></i>
            {{ __('Reportes de Red') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-gray-800 border border-gray-700 shadow-xl sm:rounded-lg p-6 text-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Accesos rápidos</h3>
                    <span class="text-xs px-2 py-1 rounded bg-blue-900/40 text-blue-300 border border-blue-700/50">Módulo de red</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('servicios.index') }}" class="group rounded-lg border border-gray-700 bg-gray-900/40 p-4 hover:border-blue-500/60 transition-colors">
                        <div class="flex items-center gap-3">
                            <i class="ri-service-fill text-xl text-blue-400"></i>
                            <div>
                                <p class="font-medium text-white">Gestión de Servicios</p>
                                <p class="text-xs text-gray-400">Consulta y administra servicios técnicos.</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('inventario.index') }}" class="group rounded-lg border border-gray-700 bg-gray-900/40 p-4 hover:border-emerald-500/60 transition-colors">
                        <div class="flex items-center gap-3">
                            <i class="ri-list-settings-line text-xl text-emerald-400"></i>
                            <div>
                                <p class="font-medium text-white">Gestión de Inventarios</p>
                                <p class="text-xs text-gray-400">Ubica equipos y activos disponibles.</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('cartasresponsivas.index') }}" class="group rounded-lg border border-gray-700 bg-gray-900/40 p-4 hover:border-amber-500/60 transition-colors">
                        <div class="flex items-center gap-3">
                            <i class="ri-file-list-3-line text-xl text-amber-400"></i>
                            <div>
                                <p class="font-medium text-white">Cartas Responsivas</p>
                                <p class="text-xs text-gray-400">Revisa y administra cartas del área.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-gray-800 border border-gray-700 shadow-xl sm:rounded-lg p-6 text-gray-100">
                <h3 class="text-lg font-semibold text-white mb-4">Ligas de reportes</h3>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="rounded-lg border border-gray-700 bg-gray-900/40 p-4">
                        <p class="text-sm text-gray-300 mb-3">Exportaciones directas</p>
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('inventario.export.csv') }}" class="inline-flex items-center gap-2 text-sm text-cyan-300 hover:text-cyan-200">
                                <i class="ri-file-excel-2-line"></i>
                                Exportar inventario a CSV
                            </a>
                            <a href="{{ route('inventario.export.html') }}" class="inline-flex items-center gap-2 text-sm text-cyan-300 hover:text-cyan-200">
                                <i class="ri-file-code-line"></i>
                                Exportar inventario a HTML
                            </a>
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-700 bg-gray-900/40 p-4">
                        <p class="text-sm text-gray-300 mb-3">Generar PDF por ID</p>
                        <form id="form-reportes-pdf" class="space-y-3">
                            <div>
                                <label for="tipoReporte" class="block text-xs text-gray-400 mb-1">Tipo de reporte</label>
                                <select id="tipoReporte" class="w-full rounded-md border-gray-600 bg-gray-900 text-gray-100 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="service.pdf">Servicio (Individual)</option>
                                    <option value="service.pdf.cal">Servicio (Calendario)</option>
                                    <option value="service.details.pdf">Servicio (Detalles)</option>
                                    <option value="inventory.pdf">Inventario (Individual)</option>
                                    <option value="cartasresponsiva.pdf">Carta responsiva (PDF)</option>
                                </select>
                            </div>
                            <div>
                                <label for="reporteId" class="block text-xs text-gray-400 mb-1">ID del registro</label>
                                <input id="reporteId" type="number" min="1" class="w-full rounded-md border-gray-600 bg-gray-900 text-gray-100 focus:border-blue-500 focus:ring-blue-500" placeholder="Ejemplo: 15">
                            </div>
                            <button type="submit" class="inline-flex items-center gap-2 rounded-md bg-blue-600 hover:bg-blue-700 px-4 py-2 text-sm font-medium text-white">
                                <i class="ri-file-pdf-2-fill"></i>
                                Abrir reporte PDF
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-reportes-pdf');

            const routeMap = {
                'service.pdf': @json(route('service.pdf', ['id' => '__ID__'])),
                'service.pdf.cal': @json(route('service.pdf.cal', ['id' => '__ID__'])),
                'service.details.pdf': @json(route('service.details.pdf', ['id' => '__ID__'])),
                'inventory.pdf': @json(route('inventory.pdf', ['id' => '__ID__'])),
                'cartasresponsiva.pdf': @json(route('cartasresponsiva.pdf', ['id' => '__ID__'])),
            };

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const tipoReporte = document.getElementById('tipoReporte').value;
                const reporteId = document.getElementById('reporteId').value.trim();

                if (reporteId === '') {
                    return;
                }

                const reportUrl = routeMap[tipoReporte].replace('__ID__', encodeURIComponent(reporteId));
                window.open(reportUrl, '_blank');
            });
        });
    </script>
</x-app-layout>
