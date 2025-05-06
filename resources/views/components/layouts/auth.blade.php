<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>
    <body class="bg-blue-100 dark:bg-blue-50/20 relative">
        <div class="flex items-center justify-center min-h-screen w-full p-8">
            <div class="block w-full">
                {!! $slot !!}
            </div>
        </div>
        <div class="absolute top-5 right-5">
            <flux:button
                x-data
                x-on:click="$flux.dark = ! $flux.dark"
                icon="moon"
                variant="subtle"
                aria-label="Toggle dark mode"
            />
        </div>
        @fluxScripts
    </body>
</html>
