<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <title>{{ config('app.name', 'Laravel') }} {{ isset($title) ? " - {$title}" : "" }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{ $headers ?? '' }}
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            @if (session()->has('impersonate'))
                <div class="max-w-7xl mt-5 mx-auto sm:px-6 lg:px-8">
                    <div class="text-center px-4 py-3 rounded shadow-lg bg-indigo-500 text-white">
                        Has iniciado sesión como el usuario {{ auth()->user()->name }}. <a href="{{ route('impersonate.out') }}" class="font-bold">Volver a mi usuario &rarr;</a>
                    </div>
                </div>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
