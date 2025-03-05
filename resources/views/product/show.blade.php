<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
            border-radius:0.5rem;
            transition:0.2s;
        }
        .customcss2:hover {
            box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;

        }
    </style>
</head>

<body class="font-sans antialiased">
    <x-mary-main with-nav full-width class rounded>
        <x-slot:content>
            <div class="relative z-10" role="dialog" aria-modal="true">
                <div class="fixed inset-0 hidden bg-gray-500/75 transition-opacity md:block" aria-hidden="true"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4">
                        <div class="flex w-full transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl">
                            <div class="relative flex w-full items-center overflow-hidden bg-white px-4 pt-14 pb-8 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                                <a href="{{ route('components.shopping_cart_component_index') }}" x-data="{ loading: false }" @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 200)">
                                    <button x-show="!loading" type="button" class="absolute top-4 shadow-sm hover:shadow-lg right-4 text-yellow-500 border border-yellow-500 hover:bg-yellow-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-600 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-yellow-600 dark:text-yellow-600 dark:hover:text-white dark:focus:ring-yellow-600 dark:hover:bg-yellow-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                        <span class="sr-only">Icon description</span>
                                    </button>
                                    <button x-show="loading" disabled type="button" class="absolute top-4 right-4 text-yellow-500 border border-yellow-500 hover:bg-yellow-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-600 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-yellow-600 dark:text-yellow-600 dark:hover:text-white dark:focus:ring-yellow-600 dark:hover:bg-yellow-600">
                                        <svg aria-hidden="true" role="status" class="inline w-6 h-6 text-gray-500 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                        </svg>
                                    </button>
                                </a>
                                <div class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 mt-5 sm:grid-cols-12 lg:gap-x-8">
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
                                        <div class="pswp-gallery grid grid-cols-2 gap-3" id="gallery">
                                            @foreach($slides as $index => $slide)
                                                <a href="{{ $slide['image'] }}" data-pswp-width="1200" data-pswp-height="800" target="_blank" class="block ">
                                                    <img src="{{ $slide['image'] }}" alt="camisa" class="w-full h-56 object-cover customcss2 bg-gray-100">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <p>No images available</p>
                                @endif
                                
        
                                    <!-- Rest of your product details -->
                                    <div class="sm:col-span-8 lg:col-span-7">
                                        <div class="gap-5 flex items-center sm:pr-12">
                                            <h2 class="text-2xl font-bold text-gray-900 ">{{$product->name}}</h2> 
                                            <div x-data="{ loaded: false }">
                                                <img 
                                                    x-data="{ loaded: false }"
                                                    x-on:load="loaded = true"
                                                    x-bind:class="loaded ? 'opacity-100' : 'opacity-0'"
                                                    loading="lazy"
                                                    class="h-10 w-10 rounded-full opacity-90" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px !important;" src="{{asset('logo.png')}}" />
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
                                                        <div class="bg-white rounded-lg overflow-hidden max-w-sm w-full">
                                                            <div class="p-6">
                                                                
                                                                <span class="rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset">Disponível em estoque </span>
                                                                <div class="mt-2 text-gray-500 text-sm">Vendido e garantido por <span class="font-semibold">Futchê®</span></div>
                                                                <div class="mt-4">
                                                                    @php
                                                                    $realPrice = $product->price;
                                                                    $discountPercentage = 21; // Fixed 21% discount
                                                                    $originalPrice = round($realPrice / (1 - ($discountPercentage / 100)), 2); // Calculate the original price before discount
                                                                @endphp
                                                            
                                                                <span class="text-2xl font-bold text-gray-900">R$ {{ number_format($realPrice, 2, ',', '.') }}</span>
                                                                <span class="text-sm text-gray-500 line-through ml-2">R$ {{ number_format($originalPrice, 2, ',', '.') }}</span>
                                                                <span class="text-sm text-green-600 ml-2">{{ $discountPercentage }}% off</span>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-mary-menu-separator />
                                                
                                                </fieldset>
                                              
                                                <div class="">
                                                    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
                                                     
                                                        <p class="text-gray-600 text-sm">Entrega estimada entre <span class="font-bold">Entrega estimada de 1 a 16 dias</span>.</p>
                                                       

<div class="flex items-center space-x-1 xl:gap-2 gap-6 my-4 max-sm:flex-wrap max-sm:justify-center max-sm:gap-2">
    <img src="{{asset('mastercard.svg')}}" alt="MasterCard" class="h-10 border border-gray-200 shadow-sm rounded-md p-1 px-2 max-sm:h-8">
    <img src="{{asset('pix.png')}}" alt="Pix" class="h-10 border border-gray-200 shadow-sm rounded-md p-1 px-2 max-sm:h-8">
    <img src="{{asset('visa.png')}}" alt="Visa" class="h-10 border border-gray-200 shadow-sm rounded-md p-3 px-2 max-sm:h-8 max-sm:p-2">
</div>
                                                        <div>
                                                            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Parcelas:</h2>
                                                           <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
    @php
        $maxParcelas = 6;
        $precoTotal = $product->price;
        $valorParcela = $precoTotal;
        
        echo '<li class="flex items-center">';
        echo '<svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
        echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />';
        echo '</svg>';
        echo "1x de R$ " . number_format($precoTotal, 2, ',', '.') . " à vista";
        echo '</li>';
        
        for ($i = 2; $i <= $maxParcelas; $i++) {
            $valorParcela = $precoTotal / $i;
            echo '<li class="flex items-center">';
            echo '<svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">';
            echo '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />';
            echo '</svg>';
            echo "$i x de R$ " . number_format($valorParcela, 2, ',', '.') . " sem juros";
            echo '</li>';
        }
    @endphp
</ul>
                                                            
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="mt-2 p-4 bg-green-50 rounded-lg gap-2 text-xs text-green-500">
                                                        <div class="flex gap-2 items-center justify-start "><img src="{{asset('pix.png')}}" class="h-14" />
                                                            <p> Com o PIX priorizamos o despacho o mais breve possível!
                                                            <p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @livewire('add-to-cart', ['productId' => $product->id])
                                            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js"></script>
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