<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    {{-- important but insecure as fduckj --}}
    <title>{{ $product->name }} - {{ config('app.name', 'Futchê') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- PhotoSwipe CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Livewire Styles -->
    @livewireStyles
    <style>
        .customcss {
            outline: 2px solid oklch(var(--wa)) !important;
            outline-offset: 2px !important;
            box-shadow: none !important;
            border-radius: 1rem;
            border-color: transparent !important;
        }

        input[type="checkbox"]:checked {
            background-color: oklch(var(--wa)) !important;
        }

        .customcss2 {
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
            border-radius: 0.5rem;
            transition: 0.2s;
        }

        .customcss2:hover {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;

        }
    </style>
</head>

<body class="font-sans antialiased">
    <x-mary-main with-nav full-width class rounded>
        <x-slot:content>
            <div class="relative z-10" role="dialog" aria-modal="true">
                <div class="fixed inset-0 hidden transition-opacity bg-gray-500/75 md:block" aria-hidden="true"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div
                        class="flex items-stretch justify-center min-h-full text-center md:items-center md:px-2 lg:px-4">
                        <div
                            class="flex w-full text-base text-left transition transform md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl">
                            <div
                                class="relative flex items-center w-full px-4 pb-8 overflow-hidden bg-white shadow-2xl pt-14 sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                                <a href="{{ route('components.shopping_cart_component_index') }}"
                                    x-data="{ loading: false }"
                                    @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 250)">

                                    <template x-if="!loading">
                                        <x-mary-button icon="o-arrow-uturn-left"
                                            class="absolute text-gray-500 bg-gray-200 border-none top-4 right-4" />
                                    </template>

                                    <template x-if="loading">
                                        <x-mary-button disabled class="absolute bg-gray-200 border-none top-4 right-4">
                                            <x-mary-loading class="w-6 text-gray-600" />
                                        </x-mary-button>
                                    </template>


                                </a>
                                <div
                                    class="grid items-start w-full grid-cols-1 mt-5 gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8">
                                    @php
                                    $images = $product->image;
                                    $slides = [];
                                    if (!empty($images) && is_array($images)) {
                                    foreach ($images as $image) {
                                    $slides[] = [
                                    'image' => asset('storage/' . $image),
                                    'description' => $product->description,
                                    ];
                                    }
                                    }
                                    @endphp

                                    @if(!empty($slides))
                                    <div class="w-full sm:h-screen sm:col-span-4 lg:col-span-5">
                                        <div class="grid grid-cols-2 gap-3 pswp-gallery" id="gallery">
                                            @foreach($slides as $index => $slide)
                                            <a href="{{ $slide['image'] }}" data-pswp-width="1200"
                                                data-pswp-height="800" target="_blank" class="block ">
                                                <img src="{{ $slide['image'] }}" alt="camisa"
                                                    class="object-cover w-full h-56 bg-gray-100 customcss2">
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @else
                                    <p>No images available</p>
                                    @endif


                                    <!-- Rest of your product details -->
                                    <div class="sm:col-span-8 lg:col-span-7">
                                        <div class="flex items-center gap-5 sm:pr-12">
                                            <h2 class="text-2xl font-bold text-gray-900 ">{{$product->name}}</h2>
                                            <div x-data="{ loaded: false }">
                                                <img x-data="{ loaded: false }" x-on:load="loaded = true"
                                                    x-bind:class="loaded ? 'opacity-100' : 'opacity-0'" loading="lazy"
                                                    class="w-10 h-10 rounded-full opacity-90"
                                                    style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px !important;"
                                                    src="{{asset('logo.png')}}" />
                                            </div>
                                        </div>

                                        <section aria-labelledby="information-heading" class="mt-2">
                                            <h3 id="information-heading" class="sr-only">Product information</h3>
                                            <p class="text-xl text-green-500">R$ {{$product->price}}</p>

                                            <!-- Reviews -->

                                        </section>

                                        <section aria-labelledby="options-heading" class="mt-10">
                                            <h3 id="options-heading" class="sr-only">Product options</h3>
                                            <form>
                                                <fieldset class="my-2" aria-label="Choose a size">
                                                    <x-mary-menu-separator />
                                                    <div>
                                                        <div
                                                            class="w-full max-w-sm overflow-hidden bg-white rounded-lg">
                                                            <div class="p-6">

                                                                <span
                                                                    class="px-2 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 ring-1 ring-green-600/20 ring-inset">Disponível
                                                                    em estoque </span>
                                                                <div class="mt-2 text-sm text-gray-500">Vendido e
                                                                    garantido por <span
                                                                        class="font-semibold">Futchê®</span></div>
                                                                <div class="mt-4">
                                                                    @php
                                                                    $realPrice = $product->price;
                                                                    $discountPercentage = 21; // Fixed 21% discount
                                                                    $originalPrice = round($realPrice / (1 -
                                                                    ($discountPercentage / 100)), 2); // Calculate the

                                                                    @endphp

                                                                    <span class="text-2xl font-bold text-gray-900">R$ {{
                                                                        number_format($realPrice, 2, ',', '.') }}</span>
                                                                    <span
                                                                        class="ml-2 text-sm text-gray-500 line-through">R$
                                                                        {{ number_format($originalPrice, 2, ',', '.')
                                                                        }}</span>
                                                                    <span class="ml-2 text-sm text-green-600">{{
                                                                        $discountPercentage }}% off</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-mary-menu-separator />

                                                </fieldset>

                                                <div class="">
                                                    <div class="max-w-lg p-6 mx-auto bg-white rounded-lg shadow-md">

                                                        <p class="text-sm text-gray-600">Entrega estimada entre <span
                                                                class="font-bold">Entrega estimada de 1 a 16
                                                                dias</span>.</p>


                                                        <div
                                                            class="flex items-center gap-6 my-4 space-x-1 xl:gap-2 max-sm:flex-wrap max-sm:justify-center max-sm:gap-2">
                                                            <img src="{{asset('mastercard.svg')}}" alt="MasterCard"
                                                                class="h-10 p-1 px-2 border border-gray-200 rounded-md shadow-sm max-sm:h-8">
                                                            <img src="{{asset('boleto.png')}}" alt="Boleto"
                                                                class="h-10 p-1 px-2 border border-gray-200 rounded-md shadow-sm max-sm:h-8">
                                                            <img src="{{asset('pix.png')}}" alt="Pix"
                                                                class="h-10 p-1 px-2 border border-gray-200 rounded-md shadow-sm max-sm:h-8">
                                                            <img src="{{asset('caixa.svg')}}" alt="Caixa"
                                                                class="h-10 p-3 border border-gray-200 rounded-md shadow-sm max-sm:h-8 max-sm:p-2">
                                                            <img src="{{asset('visa.png')}}" alt="Visa"
                                                                class="h-10 p-3 px-2 border border-gray-200 rounded-md shadow-sm max-sm:h-8 max-sm:p-2">
                                                        </div>
                                                        <div>
                                                            <h2
                                                                class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                                                                Parcelas:</h2>
                                                            <ul
                                                                class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                                                                @php
                                                                $maxParcelas = 6;
                                                                $precoTotal = $product->price;
                                                                $valorParcela = $precoTotal;

                                                                echo '<li class="flex items-center">';
                                                                    echo '<svg
                                                                        class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 shrink-0"
                                                                        aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="currentColor" viewBox="0 0 20 20">';
                                                                        echo '
                                                                        <path
                                                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                                        ';
                                                                        echo '
                                                                    </svg>';
                                                                    echo "1x de R$ " . number_format($precoTotal, 2,
                                                                    ',', '.') . " à vista";
                                                                    echo '</li>';

                                                                for ($i = 2; $i <= $maxParcelas; $i++) {
                                                                    $valorParcela=$precoTotal / $i;
                                                                    echo '<li class="flex items-center">' ;
                                                                    echo '<svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">'
                                                                    ;
                                                                    echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />'
                                                                    ; echo '</svg>' ; echo "$i x de R$ " .
                                                                    number_format($valorParcela, 2, ',' , '.' )
                                                                    . " sem juros" ; echo '</li>' ; } @endphp </ul>

                                                        </div>
                                                    </div>
                                                    <div class="p-4 mt-4 text-xs text-gray-700 rounded-lg bg-gray-50">
                                                        <p class="flex items-center"><img src="{{asset('boleto.png')}}"
                                                                class="h-5 mr-2">O prazo de pagamento via boleto
                                                            bancário é de 2 dias corridos.</p>
                                                    </div>
                                                    <div
                                                        class="gap-2 p-4 mt-2 text-xs text-green-500 rounded-lg bg-green-50">
                                                        <div class="flex items-center justify-start gap-2 "><img
                                                                src="{{asset('pix.png')}}" class="h-14" />
                                                            <p> com o PIX e priorizamos o despacho o mais breve
                                                                possível!
                                                            <p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @livewire('add-to-cart', ['productId' => $product->id])
                                            </form>
                                            <a href="{{ route('components/list-cart') }}" x-data="{ loading: false }"
                                                @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 250)">
                                                <template x-if="!loading">
                                                    <x-mary-button spinner class="w-full mt-2 btn-warning"
                                                        icon="o-arrow-uturn-right">
                                                        Ir ao carrinho
                                                    </x-mary-button>
                                                </template>
                                                <template x-if="loading">
                                                    <x-mary-button class="w-full mt-2 btn-warning">
                                                        <x-mary-loading class="w-6 text-gray-800" />
                                                    </x-mary-button>
                                                </template>
                                            </a>



                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot:content>
    </x-mary-main>

    {{-- TOAST area --}}
    <x-mary-toast />

    <!-- PhotoSwipe Scripts -->
    <script src=" https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const lightbox = new PhotoSwipeLightbox({
                gallery: '#gallery',
                children: 'a',
                pswpModule: PhotoSwipe
            });
            lightbox.init();
        });
    </script>
</body>

</html>