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
                <x-mary-button label="" icon="o-user" class="btn-ghost btn-md" tooltip-left="Minha conta" responsive />
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


        @unless (request()->is('termos-e-servicos'))
        <a href="{{ route('components.order-list-index') }}" class="relative" x-data="{ loading: false }"
            @click.prevent="
                loading = true;
                setTimeout(() => {
                    window.location.href = $el.getAttribute('href');
                }, 800); // Artificial delay of 800ms
            ">
            <span x-show="!loading">
                <x-mary-button label="Minhas compras" icon="o-list-bullet" class="btn-ghost btn" responsive />
            </span>
            <span x-show="loading">
                <x-mary-button class="btn-ghost btn relative">
                    <x-mary-loading class="dark:text-gray-500 text-gray-500" />
                </x-mary-button>
            </span>
        </a>
        @endunless
        <a href="mailto:Futche.sports@gmail.com">
            <x-mary-button label="Entre em contato" icon="o-chat-bubble-left-right" class="btn-ghost btn-sm lg:btn"
                responsive />
        </a>
        <a href="{{ route('components.shopping_cart_component_index') }}" class="relative" x-data="{ loading: false }"
            @click.prevent="
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
