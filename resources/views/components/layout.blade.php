<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistema de Agenda' }} - CUCSH</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'udg-blue': '#202945',
                        'udg-red': '#B12028',
                        'udg-green': '#8F993E',
                        'udg-yellow': '#FDCF85',
                    }
                }
            }
        }
    </script>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-udg-blue shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('eventos.index') }}" class="flex items-center">
                        <span class="text-white text-xl font-bold">CUCSH Agenda</span>
                    </a>
                    
                    <div class="hidden md:ml-10 md:flex md:space-x-4">
                        <a href="{{ route('eventos.index') }}" 
                           class="text-gray-300 hover:bg-udg-blue/80 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Eventos
                        </a>
                        
                        @can('catalogos.ver')
                        <div class="relative group">
                            <button class="text-gray-300 hover:bg-udg-blue/80 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                Catálogos
                            </button>
                            <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-1 py-1 w-48 z-10">
                                <a href="{{ route('institutos.index') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Instituciones
                                </a>
                                <a href="{{ route('tipos-evento.index') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Tipos de Evento
                                </a>
                                <a href="{{ route('dependencias.index') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Dependencias
                                </a>
                                <a href="{{ route('organizadores.index') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Organizadores
                                </a>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
                
                <div class="flex items-center">
                    @auth
                        <span class="text-gray-300 text-sm mr-4">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-gray-300 hover:bg-udg-blue/80 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                Cerrar Sesión
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                           class="text-gray-300 hover:bg-udg-blue/80 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" 
                           class="ml-2 text-gray-300 hover:bg-udg-blue/80 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Alerts -->
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        
        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif
        
        @if ($errors->any())
            <x-alert type="error">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        @endif

        <!-- Page Content -->
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-udg-blue mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-gray-300 text-sm">
                &copy; {{ date('Y') }} Universidad de Guadalajara - CUCSH. Todos los derechos reservados.
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>