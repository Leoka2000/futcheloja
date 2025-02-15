<!-- resources/views/product/show.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="photoswipe/dist/photoswipe.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles


    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased">

    <x-mary-nav sticky full-width class="shadow-sm">
        <x-slot:brand>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-mary-icon name="o-bars-3" class="cursor-pointer" />
            </label>
            <img class='object-cover w-12 h-12 rounded-md' src="{{ asset('logo.png') }}" alt="logo" title="logo" />
        </x-slot:brand>
        <x-slot:actions>
            <x-mary-button label="" icon="o-shopping-cart" link="#" class="btn relative" responsive><livewire:shopping-cart-icon /></x-mary-button>
            <x-mary-button label="" icon="o-user" link="{{route('profile.show')}}" class="btn-ghost btn" responsive />
            <x-mary-theme-toggle class="btn btn-ghost btn-square" responsive />
        </x-slot:actions>
    </x-mary-nav>

    <x-mary-main with-nav full-width>
        <livewire:components.sidebar />
        <x-slot:content>
            <div class="relative z-10" role="dialog" aria-modal="true">
                <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
                <div class="fixed inset-0 hidden bg-gray-500/75 transition-opacity md:block" aria-hidden="true"></div>

                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4">
                        <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
          To: "opacity-100 translate-y-0 md:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 md:scale-100"
          To: "opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
      -->
                        <div class="flex w-full transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl">
                            <div class="relative flex w-full items-center overflow-hidden bg-white px-4 pt-14 pb-8 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                                <button type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8">
                                    <span class="sr-only">Close</span>
                                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <div class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8">

                                    @php
                                    // Decode the JSON string of images into an array
                                    $images = $product->image;

                                    // Prepare the slides array for the carousel
                                    $slides = [];
                                    if (!empty($images) && is_array($images)) {
                                    foreach ($images as $image) {
                                    $slides[] = [
                                    'image' => asset('storage/' . $image), // Ensure the path is correct

                                    'description' => $product->description,
                                    ];
                                    }
                                    }
                                    @endphp

                                    @if(!empty($slides))
                                    <!-- Display the carousel -->
                                    <div class="w-full h-screen sm:col-span-4 lg:col-span-5">
                                        <x-mary-carousel :slides="$slides" class="w-full h-full min-h-screen rounded-lg bg-gray-100 object-cover" />
                                    </div>
                                    @else
                                    <p>No images available</p>
                                    @endif
                                    <div class="sm:col-span-8 lg:col-span-7">
                                        <div class="gap-5 flex items-center sm:pr-12">
                                            <h2 class="text-2xl font-bold text-gray-900 ">Basic Tee 6-Pack</h2> <img class="h-10 w-10 rounded-full opacity-90" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px !important;" src="{{asset('bandeira.png')}}" />
                                        </div>
                                        <!-- </div> -->

                                        <section aria-labelledby="information-heading" class="mt-2">
                                            <h3 id="information-heading" class="sr-only">Product information</h3>

                                            <p class="text-xl  text-green-500">R$ {{$product->price}}</p>

                                            <!-- Reviews -->
                                            <div class="mt-6">
                                                <h4 class="sr-only">Reviews</h4>
                                                <div class="flex items-center">
                                                    <div class="flex items-center">
                                                        <!-- Active: "text-gray-900", Default: "text-gray-200" -->
                                                        <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                                                        </svg>
                                                        <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                                                        </svg>
                                                        <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                                                        </svg>
                                                        <svg class="size-5 shrink-0 text-gray-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                                                        </svg>
                                                        <svg class="size-5 shrink-0 text-gray-200" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                                                        </svg>

                                                    </div>
                                                    <p class="sr-only">3.9 out of 5 stars</p>
                                                    <a href="#" class="ml-3 text-sm font-medium text-yellow-500 hover:text-yellow-500">117 reviews</a>
                                                </div>
                                            </div>
                                        </section>

                                        <section aria-labelledby="options-heading" class="mt-10">
                                            <h3 id="options-heading" class="sr-only">Product options</h3>

                                            <form>
                                            <fieldset class="my-10" aria-label="Choose a size">
                                                    <x-mary-menu-separator />
                                                    <div>
                                                        <div class="bg-white rounded-lg overflow-hidden max-w-sm w-full">
                                                            <div class="p-6">
                                                                <span class="text-sm text-gray-500">Cód. Item 9846903013665</span>

                                                                <span class=" rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset">Disponível em estoque </span>
                                                                <div class="mt-2 text-gray-500 text-sm">Vendido e garantido por <span class="font-semibold">Mega Manto Sport®</span></div>

                                                                <div class="mt-4">
                                                                    <span class="text-2xl font-bold text-gray-900">R$ 189,90</span>
                                                                    <span class="text-sm text-gray-500 line-through ml-2">R$ 299,90</span>
                                                                    <span class="text-sm text-green-600 ml-2">37% off</span>
                                                                </div>

                                                                <div class="mt-4">
                                                                    <div class="flex items-center">
                                                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-indigo-G transition duration-150 ease-in-out">
                                                                        <span class="ml-2 text-sm text-gray-700">em até <strong>12x<strong> de <span class="text-red-500">R$ 19,24</span>
                                                                    </div>
                                                                    <div class="mt-2 text-sm text text-gray-700">Economia de R$ 110,00</div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <x-mary-menu-separator />

                                                    <div class="flex items-center mt-6 justify-between">
                                                        <div class="text-sm font-medium text-gray-900">Size</div>
                                                        <a href="#" class="text-sm font-medium text-yellow-500 hover:text-yellow-400">Size guide</a>
                                                    </div>

                                                    <div class="mt-4 grid grid-cols-4 gap-4">
                                                        <!-- Active: "ring-2 ring-yellow-500" -->
                                                        <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1">
                                                            <input type="radio" name="size-choice" value="XXS" class="sr-only">
                                                            <span>XXS</span>
                                                            <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-yellow-500", Not Checked: "border-transparent"
                        -->
                                                            <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                                                        </label>
                                                        <!-- Active: "ring-2 ring-yellow-500" -->
                                                        <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1">
                                                            <input type="radio" name="size-choice" value="XS" class="sr-only">
                                                            <span>XS</span>
                                                            <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-yellow-500", Not Checked: "border-transparent"
                        -->
                                                            <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                                                        </label>
                                                        <!-- Active: "ring-2 ring-yellow-500" -->
                                                        <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1">
                                                            <input type="radio" name="size-choice" value="S" class="sr-only">
                                                            <span>S</span>
                                                            <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-yellow-500", Not Checked: "border-transparent"
                        -->
                                                            <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                                                        </label>
                                                        <!-- Active: "ring-2 ring-yellow-500" -->
                                                        <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1">
                                                            <input type="radio" name="size-choice" value="M" class="sr-only">
                                                            <span>M</span>
                                                            <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-yellow-500", Not Checked: "border-transparent"
                        -->
                                                            <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                                                        </label>
                                                        <!-- Active: "ring-2 ring-yellow-500" -->
                                                        <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1">
                                                            <input type="radio" name="size-choice" value="L" class="sr-only">
                                                            <span>L</span>
                                                            <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-yellow-500", Not Checked: "border-transparent"
                        -->
                                                            <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                                                        </label>
                                                        <!-- Active: "ring-2 ring-yellow-500" -->
                                                        <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1">
                                                            <input type="radio" name="size-choice" value="XL" class="sr-only">
                                                            <span>XL</span>
                                                            <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-yellow-500", Not Checked: "border-transparent"
                        -->
                                                            <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                                                        </label>
                                                        <!-- Active: "ring-2 ring-yellow-500" -->
                                                        <label class="group relative flex cursor-pointer items-center justify-center rounded-md border bg-white px-4 py-3 text-sm font-medium text-gray-900 uppercase shadow-xs hover:bg-gray-50 focus:outline-hidden sm:flex-1">
                                                            <input type="radio" name="size-choice" value="XXL" class="sr-only">
                                                            <span>XXL</span>
                                                            <!--
                          Active: "border", Not Active: "border-2"
                          Checked: "border-yellow-500", Not Checked: "border-transparent"
                        -->
                                                            <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                                                        </label>
                                                        <!-- Active: "ring-2 ring-yellow-500" -->
                                                        <label class="group relative flex cursor-not-allowed items-center justify-center rounded-md border bg-gray-50 px-4 py-3 text-sm font-medium text-gray-200 uppercase hover:bg-gray-50 focus:outline-hidden sm:flex-1">
                                                            <input type="radio" name="size-choice" value="XXXL" disabled class="sr-only">
                                                            <span>XXXL</span>
                                                            <span aria-hidden="true" class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200">
                                                                <svg class="absolute inset-0 size-full stroke-2 text-gray-200" viewBox="0 0 100 100" preserveAspectRatio="none" stroke="currentColor">
                                                                    <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke" />
                                                                </svg>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                                <!-- Colors -->
                                                <fieldset aria-label="Choose a color">
                                                    <legend class="text-sm font-medium text-gray-900">Color</legend>

                                                    <div class="mt-4 flex items-center gap-x-3">
                                                        <!-- Active and Checked: "ring-3 ring-offset-1" -->
                                                        <label aria-label="White" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-hidden">
                                                            <input type="radio" name="color-choice" value="White" class="sr-only">
                                                            <span aria-hidden="true" class="size-8 rounded-full border border-black/10 bg-white"></span>
                                                        </label>
                                                        <!-- Active and Checked: "ring-3 ring-offset-1" -->
                                                        <label aria-label="Gray" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-hidden">
                                                            <input type="radio" name="color-choice" value="Gray" class="sr-only">
                                                            <span aria-hidden="true" class="size-8 rounded-full border border-black/10 bg-gray-200"></span>
                                                        </label>
                                                        <!-- Active and Checked: "ring-3 ring-offset-1" -->
                                                        <label aria-label="Black" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-900 focus:outline-hidden">
                                                            <input type="radio" name="color-choice" value="Black" class="sr-only">
                                                            <span aria-hidden="true" class="size-8 rounded-full border border-black/10 bg-gray-900"></span>
                                                        </label>
                                                    </div>
                                                </fieldset>

                                                <!--    MEU CODIGOOO-->
                                                <div class="my-2">
                                                    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
                                                        <div class="text-sm text-gray-700 mb-2">
                                                            <span class="font-bold text-green-600">Frete Grátis</span> para <span class="font-bold">Budapest, BU, Hungary e Região</span>
                                                        </div>
                                                        <p class="text-gray-600 text-sm">Entrega estimada entre <span class="font-bold">01 e 16 de março</span>.</p>

                                                        <div class="flex-inline  items-center flex space-x-1 xl:gap-2 gap-6 my-4">

                                                            <img src="{{asset('mastercard.svg')}}" alt="MasterCard" class="h-10 border border-gray-200 shadow-sm rounded-md p-1 px-2">

                                                            <img src="{{asset('boleto.png')}}" alt="Boleto" class="h-10 border border-gray-200 shadow-sm rounded-md p-1 px-2">
                                                            <img src="{{asset('pix.png')}}" alt="Pix" class="h-10 border border-gray-200 shadow-sm rounded-md p-1 px-2">

                                                            <img src="{{asset('caixa.svg')}}" alt="Caixa" class="h-10 border border-gray-200 shadow-sm rounded-md p-3">
                                                            <img src="{{asset('visa.png')}}" alt="Visa" class="h-10 border border-gray-200 shadow-sm rounded-md p-3 px-2">
                                                            <img src="{{asset('mercadopago.svg')}}" alt="Mercado Pago" class="h-10 border border-gray-200 shadow-sm rounded-md ">


                                                        </div>

                                                        <!-- ACCORDION -->
                                                        <div>


                                                        </div>
                                                        <div>
                                                            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Parcelas:</h2>
                                                            <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                                                                <li class="flex items-center">
                                                                    <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                                    </svg>
                                                                    1x de R$ 189,90 à vista
                                                                </li>
                                                                <li class="flex items-center">
                                                                    <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                                    </svg>
                                                                    2x de R$ 94,95 sem juros
                                                                </li>
                                                                <li class="flex items-center">
                                                                    <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                                    </svg>
                                                                    3x de R$ 63,30 sem juros
                                                                </li>
                                                                <li class="flex items-center">
                                                                    <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                                    </svg>
                                                                    4x de R$ 52,64*
                                                                </li>
                                                                <li class="flex items-center">
                                                                    <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                                    </svg>
                                                                    *Com juros
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- ACCORDION -->
                                                    </div>

                                                    <div class="mt-4 p-4 bg-gray-50 rounded-lg text-xs text-gray-700">
                                                        <p class="flex items-center"><img src="{{asset('boleto.png')}}" class="h-5 mr-2">O prazo de pagamento via boleto bancário é de 2 dias corridos.</p>
                                                    </div>

                                                    <div class="mt-2 p-4  bg-green-50 rounded-lg gap-2 text-xs text-green-500">
                                                        <div class="flex gap-2  items-center justify-start "><img src="{{asset('pix.png')}}" class="h-14" />
                                                            <p> com o PIX e priorizamos o despacho o mais breve possível!
                                                            <p>
                                                        </div>
                                                    </div>


                                                </div>

                                                

                                                <x-mary-button type="submit" class="mt-6 w-full btn-warning" icon="o-shopping-cart">Add to bag</x-mary-button>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.4/photoswipe.min.css" integrity="sha512-LFWtdAXHQuwUGH9cImO9blA3a3GfQNkpF2uRlhaOpSbDevNyK1rmAjs13mtpjvWyi+flP7zYWboqY+8Mkd42xA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.4/photoswipe-lightbox.esm.min.js" integrity="sha512-S9RkWnGja84tXKFxTN7iLVP3pUCsnfqnF+0ZK2CSOhmCqa6lxoutHUoizBVnqCIsH8HW7e/3u9HEOOwlR01TLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.4/photoswipe.esm.min.js" integrity="sha512-AyqbkQ0CCFXttmj38AAryPYIKEOdL6lApyzLje2dyvMwLoHv7PPXIeKS86gF4V85Gv+ZsCiOSP0yHaCXcemmaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.4/umd/photoswipe-lightbox.umd.min.js" integrity="sha512-D16CBrIrVF48W0Ou0ca3D65JFo/HaEAjTugBXeWS/JH+1KNu54ZOtHPccxJ7PQ44rTItUT6DSI6xNL+U34SuuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/photoswipe/5.4.4/umd/photoswipe.umd.min.js" integrity="sha512-BXwwGU7zCXVgpT2jpXnTbioT9q1Byf7NEXVxovTZPlNvelL2I/4LjOaoiB2a19L+g5za8RbkoJFH4fMPQcjFFw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>