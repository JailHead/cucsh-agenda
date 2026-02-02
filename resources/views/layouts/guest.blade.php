<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
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
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="mb-6">
            <a href="/">
                <span class="text-4xl font-bold text-udg-blue">CUCSH Agenda</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
        
        <footer class="mt-8 text-center text-sm text-gray-600">
            &copy; {{ date('Y') }} Universidad de Guadalajara - CUCSH
        </footer>
    </div>
</body>
</html>