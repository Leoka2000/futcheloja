<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/png" href="{{asset('logo.png')}}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="relative font-sans antialiased">
    @unless (request()->is('login', 'register'))
    <x-mary-nav sticky full-width class="shadow-sm">
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <a class="cursor-pointer" href="/"><img class='object-cover w-12 h-12 rounded-md' src="{{ asset('logo.png') }}"
                alt="logo" title="logo" /></a>
        </x-slot:brand>
        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-button label="" icon="o-shopping-cart" link="{{route('components/list-cart')}}" class="btn relative" responsive><livewire:shopping-cart-icon /></x-mary-button>
            <x-mary-button label="" icon="o-user" link="{{route('profile.show')}}" class="btn-ghost btn" responsive />
            <x-mary-theme-toggle class="btn btn-ghost btn-square" responsive />
        </x-slot:actions>
    </x-mary-nav>
    <x-mary-nav sticky full-width class="shadow-sm top-20">
       
        {{-- Right side actions --}}
        <x-slot:actions>
            <x-mary-button label="Minhas compras" icon="o-list-bullet" link="{{route('components.order-list-index')}}" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Termos de Serviço" icon="o-information-circle" link="{{ route('policy')}}" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Entre em contato" icon="o-chat-bubble-left-right" href="mailto:Futche.sports@gmail.com" class="btn-ghost btn-sm" responsive />
            <x-mary-button label="Camisas" icon="o-shopping-cart" link="{{ route('components.shopping_cart_component_index')}}" class="btn-sm shadow-lg btn-warning" responsive />
        </x-slot:actions>
    </x-mary-nav>
    @endunless

    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>
        @unless (request()->is('login', 'register'))
        <livewire:components.sidebar />
        @endunless


        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>

    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
    <x-footer />
</body>

</html>