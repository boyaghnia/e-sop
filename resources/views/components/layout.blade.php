<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="flex min-h-screen flex-col bg-gray-200">
        <header>
            <x-header></x-header>
        </header>

        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Konten Utama -->
        <main class="mt-20 mr-8 ml-70 flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="mt-auto mr-8 ml-80">
            {{-- <x-footer></x-footer> --}}
        </footer>
    </body>
</html>
