<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    {{-- line for not bugging webpacks --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<style>
    .custombox {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
    }
</style>

<body class="relative font-sans antialiased">
    <x-mary-nav sticky full-width class="shadow-sm">
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="mr-3 lg:hidden">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <img class='object-cover w-12 h-12 rounded-md' src="{{ asset('logo.png') }}" alt="logo" title="logo" />
        </x-slot:brand>
        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-button label="" icon="o-shopping-cart" link="#" class="relative btn" responsive>
                <livewire:shopping-cart-icon />
            </x-mary-button>
            <x-mary-button label="" icon="o-user" link="{{route('profile.show')}}" class="btn-ghost btn" responsive />
            <x-mary-theme-toggle class="btn btn-ghost btn-square" responsive />
        </x-slot:actions>
    </x-mary-nav>
    <x-mary-nav sticky full-width class="shadow-sm top-20">
        <x-slot:brand>
            <x-mary-input class="border-warning outline-warning">
                <x-slot:append>
                    <x-mary-button icon="o-magnifying-glass" class="btn-warning rounded-s-none" />
                </x-slot:append>
            </x-mary-input>
        </x-slot:brand>
        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-button label="Termos de Serviço" icon="o-information-circle" link="#" class="btn-ghost btn-sm"
                responsive />
            <x-mary-button label="Entre em contato" icon="o-chat-bubble-left-right" link="{{route('profile.show')}}"
                class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Rastrear pedido" icon="o-map-pin" link="{{route('profile.show')}}"
                class="btn-ghost btn-sm" responsive />
        </x-slot:actions>
    </x-mary-nav>
    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}


        {{-- The `$slot` goes here --}}
        <x-slot:content>
            <div class="p-6 rounded lg:p-8 dark:bg-inherit bg-gray-50 custombox">
                <livewire:shopping-cart-component />
            </div>
        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />


</body>


</html>