<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-full mx-auto sm:px-2 lg:px-2 space-y-0">
            <div class="bg-gray-800 border border-gray-700 shadow-xl sm:rounded-lg p-1 text-gray-100" x-data="deviceDetector()">
                <div class="flex items-center justify-between pb-1 mb-1 border-b border-gray-700">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <span>📱</span> Detección de Dispositivo y Pantalla
                    </h3>
                    <span class="inlin  -center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900/50 text-blue-300 border border-blue-700">
                        Tiempo real (JS)
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-gray-900/60 p-4 rounded-lg border text-center border-gray-700/60">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Dispositivo</span>
                        <p x-text="deviceType" class="text-lg font-bold text-blue-400"></p>
                    </div>

                    <div class="bg-gray-900/60 p-4 rounded-lg border text-center border-gray-700/60">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Breakpoint (Tailwind)</span>
                        <p x-text="breakpoint" class="text-lg font-bold text-purple-400"></p>
                    </div>

                    <div class="bg-gray-900/60 p-4 rounded-lg border text-center border-gray-700/60">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Resolución actual</span>
                        <p x-text="`${screenWidth}px × ${screenHeight}px`" class="text-lg font-bold text-green-400"></p>
                    </div>

                    <div class="bg-gray-900/60 p-4 rounded-lg border text-center border-gray-700/60">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Escala / Pixel Ratio</span>
                        <p x-text="`${scale}x`" class="text-lg font-bold text-yellow-400"></p>
                    </div>
                </div>

                <div class="bg-gray-900/40 p-4 rounded-lg border text-center border-gray-700/50 text-xs font-mono text-gray-400 break-all">
                    <span class="font-bold text-gray-300">Agente de usuario:</span>
                    <span x-text="userAgent"></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('deviceDetector', () => ({
                deviceType: '',
                breakpoint: '',
                screenWidth: window.innerWidth,
                screenHeight: window.innerHeight,
                scale: window.devicePixelRatio || 1,
                userAgent: navigator.userAgent,

                init() {
                    this.updateMetrics();
                    window.addEventListener('resize', () => this.updateMetrics());
                },

                updateMetrics() {
                    this.screenWidth = window.innerWidth;
                    this.screenHeight = window.innerHeight;
                    this.scale = window.devicePixelRatio || 1;

                    const userAgent = navigator.userAgent.toLowerCase();
                    const isMobileDevice = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent);
                    const isMobileWidth = this.screenWidth < 768;

                    if (isMobileDevice || isMobileWidth) {
                        this.deviceType = '📱 Móvil / Tablet';
                    } else {
                        this.deviceType = '🖥️ Escritorio';
                    }

                    if (this.screenWidth >= 1536) {
                        this.breakpoint = '2xl (≥ 1536px)';
                    } else if (this.screenWidth >= 1280) {
                        this.breakpoint = 'xl (≥ 1280px)';
                    } else if (this.screenWidth >= 1024) {
                        this.breakpoint = 'lg (≥ 1024px)';
                    } else if (this.screenWidth >= 768) {
                        this.breakpoint = 'md (≥ 768px)';
                    } else if (this.screenWidth >= 640) {
                        this.breakpoint = 'sm (≥ 640px)';
                    } else {
                        this.breakpoint = 'base (< 640px)';
                    }
                }
            }));
        });
    </script>

    @if (session('profile_updated'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: '¡Éxito!',
                    text: @json(session('profile_updated')),
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#3b82f6',
                    background: '#1f2937',
                    color: '#f9fafb',
                    backdrop: 'rgba(0,0,0,0.5)'
                });
            });
        </script>
    @endif
</x-app-layout>
