<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>
    <body class="relative min-h-screen bg-blue-50 dark:bg-blue-50/2">
        <flux:sidebar
            sticky
            stashable
            class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700"
        >
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
            <flux:navlist variant="outline">
                <flux:navlist.item icon="home" href="{{ route('homepage') }}" :current="request()->routeIs('homepage')">
                    Accueil
                </flux:navlist.item>
            </flux:navlist>
            <flux:spacer />
            <flux:navlist variant="outline">
                <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                    <flux:radio value="light" icon="sun" />
                    <flux:radio value="dark" icon="moon" />
                    <flux:radio value="system" icon="computer-desktop" />
                </flux:radio.group>
            </flux:navlist>
            <flux:dropdown position="top" align="start" class="max-lg:hidden">
                <flux:profile  name="{{ \App\Services\AuthenticationService::getActiveUser()->name }}" />
                <flux:menu>
                    <flux:menu.item
                        href="{{ route('logout') }}"
                        icon="arrow-right-start-on-rectangle"
                    >
                        Déconnexion
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>
        <flux:header class="lg:hidden fixed bottom-0 bg-zinc-50 dark:bg-zinc-900 w-full h-16">
            <flux:dropdown position="top" alignt="start">
                <flux:profile  name="{{ \App\Services\AuthenticationService::getActiveUser()->name }}" />
                <flux:menu>
                    <flux:menu.item
                        href="{{ route('logout') }}"
                        icon="arrow-right-start-on-rectangle"
                    >
                        Déconnexion
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>
            <flux:spacer />
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        </flux:header>
        <flux:main class="mb-16 overflow-hidden">
            {{ $slot }}
        </flux:main>
        @fluxScripts
    </body>
</html>
