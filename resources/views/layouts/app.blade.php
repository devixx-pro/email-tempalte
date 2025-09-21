<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Vite (Tailwind/JS) --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    {{-- Extra per-page styles --}}
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
    <header class="bg-white border-b">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ url('/') }}" class="text-lg font-semibold tracking-tight">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="flex items-center gap-6">
                    <a href="{{ route('imports.index') }}"
                       class="text-sm text-gray-700 hover:text-gray-900">
                        Imports
                    </a>
                    {{-- Add more nav links as needed --}}
                </div>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        {{-- Flash status --}}
        @if (session('status'))
            <div class="mb-4 rounded border border-green-300 bg-green-50 px-4 py-3 text-green-800">
                {{ session('status') }}
            </div>
        @endif

        {{-- Validation errors (global) --}}
        @if ($errors->any())
            <div class="mb-4 rounded border border-red-300 bg-red-50 px-4 py-3 text-red-800">
                <div class="font-semibold mb-1">Please fix the following:</div>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif>

        @yield('content')
    </main>

    <footer class="mt-12 border-t bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 text-sm text-gray-500">
            &copy; {{ now()->year }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </div>
    </footer>

    {{-- Extra per-page scripts --}}
    @stack('scripts')
</body>
</html>
