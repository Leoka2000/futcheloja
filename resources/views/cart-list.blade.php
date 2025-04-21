<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/png" href="{{asset('logo.png')}}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- line for not bugging webpacks --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <x-mary-nav sticky full-width class="shadow-sm">
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="mr-3 lg:hidden">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <a class="cursor-pointer" href="/"><img class='object-cover w-12 h-12 rounded-md'
                    src="{{ asset('logo.png') }}" alt="logo" title="logo" /></a>
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
            <x-mary-button label="Termos e Serviço" icon="o-information-circle" link="{{ route('policy')}}"
                class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Entre em contato" icon="o-chat-bubble-left-right"
                href="mailto:Futche.sports@gmail.com" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Rastrear pedido" icon="o-map-pin" link="{{route('profile.show')}}"
                class="btn-ghost btn-sm" responsive />
        </x-slot:actions>
    </x-mary-nav>
    <x-mary-main with-nav full-width>



        {{-- The `$slot` goes here --}}
        <x-slot:content>

            <x-list-cart />

        </x-slot:content>

    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />

</body>

</html>