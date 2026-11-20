<!DOCTYPE html>
<html lang="en">
@props(['addRoute' => false, 'addText' => '+ Add Idea', 'title' => ''])

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? $title . ' - ' : '' }} Ideas App</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-b from-slate-50 to-slate-100">
    <!-- Navigation Bar -->
    <nav class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur-sm">
        <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('welcome') }}"
                    class="flex items-center gap-2 text-xl font-bold text-slate-900 transition-colors duration-200 hover:text-blue-600">
                    <span class="text-2xl">🗒️</span>
                    <span class="hidden sm:inline">Ideas App</span>
                </a>

                <!-- Navigation Links -->
                <div class="flex items-center gap-1">
                    <ul class="flex gap-1">
                        <x-navlink href="{{ route('ideas.index') }}">View Ideas</x-navlink>
                        <x-navlink href="{{ route('about') }}">About Us</x-navlink>
                        <x-navlink href="{{ route('contact') }}">Contact Us</x-navlink>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-900 sm:text-xl">{{ $title }}</h1>
            </div>
            @if ($addRoute)
                <a href="{{ route($addRoute) }}"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-2 font-medium text-white transition-all duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 active:bg-blue-800">
                    {{ $addText }}
                </a>
            @endif
        </div>

        <!-- Main Content Area -->
        <main class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
