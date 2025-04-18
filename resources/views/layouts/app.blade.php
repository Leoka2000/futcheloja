<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Futchê') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased relative">
    <x-mary-nav sticky full-width class="shadow-sm">
        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <a class="cursor-pointer" href="/"><img class='object-cover w-12 h-12 rounded-md'
                    src="{{ asset('logo.png') }}" alt="logo" title="logo" /></a>
        </x-slot:brand>
        {{-- Right side actions --}}
        <x-slot:actions>
            <a href="{{ route('components/list-cart') }}" class="relative" x-data="{ loading: false }" @click.prevent="
                loading = true;
                setTimeout(() => {
                    window.location.href = $el.getAttribute('href');
                }, 800); // Artificial delay of 800ms
            ">
                <span x-show="!loading">
                    <x-mary-button label="" icon="o-shopping-cart" class="btn-sm lg:btn relative"
                        tooltip-left="Meu carrinho" responsive>
                        <livewire:shopping-cart-icon />
                    </x-mary-button>
                </span>
                <span x-show="loading">
                    <x-mary-button class="btn-sm lg:btn relative">
                        <x-mary-loading class="dark:text-gray-500 text-gray-500" />
                    </x-mary-button>
                </span>
            </a>

            <!-- Button: Minha Conta -->
            <a href="{{ route('profile.show') }}" class="relative" x-data="{ loading: false }" @click.prevent="
                loading = true;
                setTimeout(() => {
                    window.location.href = $el.getAttribute('href');
                }, 800); // Artificial delay of 800ms
            ">
                <span x-show="!loading">
                    <x-mary-button label="" icon="o-user" class="btn-ghost btn-md" tooltip-left="Minha conta"
                        responsive />
                </span>
                <span x-show="loading">
                    <x-mary-button class="btn-ghost btn-md relative">
                        <x-mary-loading class="dark:text-gray-500 text-gray-500" />
                    </x-mary-button>
                </span>
            </a>
            <x-mary-theme-toggle class="btn btn-ghost btn-square" responsive />
        </x-slot:actions>
    </x-mary-nav>
    <x-mary-nav sticky full-width class="shadow-sm top-20">
        {{-- Right side actions --}}
        <x-slot:actions>

            <x-mary-button label="Minhas compras" icon="o-list-bullet" link="{{route('components.order-list-index')}}"
                class="lg:btn-ghost  btn-sm lg:btn" responsive />
            <a href="mailto:Futche.sports@gmail.com">
                <x-mary-button label="Entre em contato" icon="o-chat-bubble-left-right" class="btn-ghost btn-sm lg:btn"
                    responsive />
            </a>

            <a href="{{ route('components.shopping_cart_component_index') }}" class="relative"
                x-data="{ loading: false }" @click.prevent="
           loading = true;
           setTimeout(() => {
               window.location.href = $el.getAttribute('href');
           }, 800); // Artificial delay of 800ms
       ">
                <span x-show="!loading">
                    <x-mary-button label="Camisas" icon="o-shopping-bag"
                        class="lg:w-64 lg:btn-warning shadow-sm btn-warning" responsive />
                </span>
                <span x-show="loading">
                    <x-mary-button class="lg:w-64 lg:btn-outline shadow-lg btn-warning relative">
                        <x-mary-loading class="dark:text-gray-500 text-gray-500" />
                    </x-mary-button>
                </span>
            </a>



        </x-slot:actions>
    </x-mary-nav>

    {{-- The main content with `full-width` --}}
    <x-mary-main with-nav full-width>


        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />


    <script src="//unpkg.com/alpinejs" defer></script>
    <x-footer />
</body>

</html>
