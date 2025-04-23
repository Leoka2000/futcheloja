<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

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


<body>
    {{-- nao remova este navbar pois o codigo esta muito ruim e por algum motivo que nao tenho tempo e tbm preguica nao
    alterarei. Apenas o deixe ai --}}
    <x-navbar-cart-list />
    <section class="py-8 antialiased bg-white dark:bg-gray-900 md:py-16">

        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <a href="{{ route('livewire.components.hero') }}" x-data="{ loading: false }"
                @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 200)">
                <x-mary-button icon="o-arrow-uturn-left" class="w-full mb-10 btn md:w-96 "> Voltar </x-mary-button>
            </a>

            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Meu carrinho</h2>

            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="flex-none w-full mx-auto lg:max-w-2xl xl:max-w-4xl">

                    <div class="space-y-6">
                        @if($cartItems->isEmpty())
                        <div
                            class="flex flex-col items-center gap-1 p-4 border border-gray-100 rounded-lg shadow-lg dark:border-gray-800 md:p-6">
                            <x-mary-icon name="o-x-mark"
                                class="w-12 h-12 p-2 text-gray-400 bg-gray-200 rounded-full shadow dark:bg-gray-700 darktext-gray-500" />
                            <p class="text-center text-gray-900 dark:text-white">Não há compras </p>
                            <a href="{{ route('components.shopping_cart_component_index') }}"
                                x-data="{ loading: false }"
                                @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 250)">
                                <template x-if="!loading">

                                    <x-mary-button class="w-full mt-2 btn-warning" icon="o-shopping-cart">
                                        Realize sua primeira compra
                                    </x-mary-button>

                                </template>
                                <template x-if="loading">
                                    <x-mary-button class="w-full mt-2 btn-warning">
                                        <x-mary-loading class="w-6 text-gray-800" />
                                    </x-mary-button>
                                </template>
                            </a>
                        </div>
                        @else
                        @foreach($cartItems as $item)
                        @php
                        $productImages = is_array($item->product->image) ? $item->product->image : [];
                        $firstImage = !empty($productImages) ? $productImages[0] : 'default-image.png'; // fallbackimage
                        @endphp
                        <div
                            class="relative p-4 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 md:p-6">
                            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                <a href="#" class="shrink-0 md:order-1">
                                    <img class="w-24 h-24" src="{{ Storage::url($firstImage) }}"
                                        alt="{{ $item->product->name }}" />
                                </a>
                                <label for="counter-input-{{ $item->id }}" class="sr-only">Choose quantity:</label>
                                <div class="flex items-center justify-between md:order-3 md:justify-end">
                                    <div class="flex items-center ml-">
                                        <form action="{{ route('cart.decrease', ['productId' => $item->product_id]) }}"
                                            method="POST" x-data="{ loading: false }">
                                            @csrf
                                            @method('POST')
                                            <a type="submit" class="" :disabled="loading" @click.prevent="
                          loading = true;
                          setTimeout(() => {
                              $el.closest('form').submit();
                          }, 1000);
                      ">
                                                <span x-show="!loading">
                                                    <x-mary-button icon="o-minus"
                                                        class="text-red-500 btn-circle dark:red-400 btn-sm" />
                                                </span>
                                                <span x-show="loading" x-cloak>
                                                    <x-mary-button
                                                        class="relative text-green-500 btn-circle dark:green-400 btn-sm">
                                                        <x-mary-loading class="text-gray-500 dark:text-gray-500" />
                                                    </x-mary-button>
                                                </span>
                                            </a>
                                        </form>
                                        <x-mary-input style="width:50px!important;" readonly type="text"
                                            id="counter-input-{{ $item->id }}" data-input-counter
                                            class="mx-2 text-sm font-medium text-center text-gray-900 bg-transparent border-0 btn-sm shrink-0 focus:outline-none focus:ring-0 dark:text-white"
                                            placeholder="" value="{{ $item->quantity }}" />
                                        <form action="{{ route('cart.increase', ['productId' => $item->product_id]) }}"
                                            method="POST" x-data="{ loading: false }">
                                            @csrf
                                            @method('POST')
                                            <a type="submit" class="" :disabled="loading" @click.prevent="
                          loading = true;
                          setTimeout(() => {
                              $el.closest('form').submit();
                          }, 1000);
                      ">
                                                <span x-show="!loading">
                                                    <x-mary-button icon="o-plus"
                                                        class="text-green-500 btn-circle dark:green-400 btn-sm" />
                                                </span>
                                                <span x-show="loading" x-cloak>
                                                    <x-mary-button
                                                        class="relative text-green-500 btn-circle dark:green-400 btn-sm">
                                                        <x-mary-loading class="text-gray-400 dark:text-gray-500" />
                                                    </x-mary-button>
                                                </span>
                                            </a>
                                        </form>
                                    </div>

                                    <div class="text-end md:order-4 md:w-32">
                                        <p class="text-base font-bold text-gray-900 dark:text-white">R${{
                                            number_format($item->product->price * $item->quantity, 2) }}</p>
                                    </div>
                                </div>
                                {{-- contaiber de tudo --}}
                                @if($item->size)
                                <div class="text-sm text-gray-600 dark:text-gray-400">

                                    <span class="font-medium text-yellow-500 dark:text-yellow-400">{{ $item->size
                                        }}</span>
                                </div>
                                @endif
                                <div class="absolute -top-2 sm:top-2 right-2 ">
                                    <form action="{{ route('cart.remove', ['productId' => $item->product_id]) }}"
                                        method="POST" x-data="{ loading: false }">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" class="" :disabled="loading" @click.prevent="
                  loading = true;
                  setTimeout(() => {
                      $el.closest('form').submit();
                  }, 200);
              "> <span x-show="!loading">
                                                <x-mary-button type="submit" icon="o-trash"
                                                    class="inline-flex text-red-500 btn-sm btn-circle dark:red-400 ">
                                                </x-mary-button>
                                            </span>
                                            <span x-show="loading" x-cloak>
                                                <x-mary-button type="submit"
                                                    class="relative inline-flex text-red-500 btn-sm btn-circle dark:text-red-400 ">
                                                    <x-mary-loading class="text-gray-400 dark:text-gray-500" />
                                                </x-mary-button>
                                            </span>
                                        </a>
                                    </form>
                                </div>
                                <div class="flex-1 w-full min-w-0 space-y-4 md:order-2 md:max-w-md">


                                    <div class="flex items-center gap-4 mt-3">
                                        <form x-data="{ loading: false }"
                                            x-on:submit.prevent="loading = true; setTimeout(() => $el.submit(), 300)"
                                            action="{{ route('cart.updateSize', ['cartId' => $item->id]) }}"
                                            method="POST" class="w-full">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">

                                            <div class="flex items-center gap-2 mb-4">
                                                <x-mary-radio :options="[
                                    ['id' => 'P', 'name' => 'P'],
                                    ['id' => 'M', 'name' => 'M'],
                                    ['id' => 'G', 'name' => 'G'],
                                    ['id' => 'GG', 'name' => 'GG'],
                                    ['id' => '2GG', 'name' => '2GG'],
                                    ['id' => '3GG', 'name' => '3GG']
                                ]" wire:model="size" name="size" option-value="id" option-label="name" color="warning"
                                                    class="flex-1 w-full md:btn btn-sm " />

                                                <x-mary-button type="submit"
                                                    class="relative px-4 py-2 text-sm font-medium border-none md:btn btn-sm"
                                                    x-bind:disabled="loading">
                                                    <span x-show="!loading">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="w-4 h-4 text-gray-800 dark:text-white" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg>
                                                    </span>
                                                    <span class="w-full" x-show="loading" x-cloak>
                                                        <x-mary-loading class="absolute top-[11px] left-[6px]" />
                                                    </span>
                                                </x-mary-button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <h2 class="mt-6 mb-6 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Informações de
                        entrega</h2>
                    @livewire('shopping-cart-form', ['brazilStates' => $brazilStates])
                </div>

                <div class="flex-1 max-w-4xl mx-auto mt-6 space-y-6 lg:mt-0 lg:w-full">
                    <div
                        class="p-4 space-y-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Preço original</p>
                        @php
                        $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
                        @endphp
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Preço original
                                    </dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                                        ${{number_format($totalPrice, 2) }}</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Frete</dt>
                                    <dd class="text-base font-medium text-green-600"> <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-700 rounded-md bg-green-50 dark:bg-green-200 ring-1 ring-green-600/20 dark:ring-green-500 ring-inset">
                                            Grátis</span></dd>
                                </dl>
                            </div>

                            <dl
                                class="flex items-center justify-between gap-4 pt-2 border-t border-gray-200 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>

                                <dd style="border:transparent!important;"
                                    class="text-base font-bold text-gray-900 dark:text-white">
                                    ${{number_format($totalPrice, 2) }}</dd>
                            </dl>
                        </div>
                        <div class="flex items-center gap-3 my-1 space-x-1 flex-inline xl:gap-2">
                            <img src="{{asset('mastercard.svg')}}" alt="MasterCard"
                                class="h-5 p-1 px-2 border border-gray-200 rounded-md shadow-sm dark:border-gray-600">
                            <img src="{{asset('visa.png')}}" alt="Visa"
                                class="h-5 p-[4px] border border-gray-200 dark:border-gray-600  shadow-sm rounded-md ">
                        </div>
                        @if($cartItems->isEmpty())
                        {{-- <a>
                            <x-mary-button icon="o-credit-card" tooltip="Your cart is empty!" class="w-full mt-3">Pagar
                                com cartão </x-mary-button>
                        </a> --}}
                        <div class="flex items-center justify-center gap-2">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> </span>
                            <a title=""
                                class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 hover:no-underline dark:text-primary-500">
                                Continue com pix
                                <img src="{{asset('pix.png')}}" alt="Pix"
                                    class="border border-gray-200 rounded-md shadow-sm h-7 dark:border-gray-600 -p-36">
                            </a>
                            @else
                            <a href="{{route('checkout')}}">
                                <x-mary-button icon="o-credit-card" type="submit" spinner="checkout"
                                    class="w-full mt-3"> Pagar com cartão </x-mary-button>
                            </a>
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                                <a title=""
                                    class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 hover:no-underline dark:text-primary-500">
                                    Continue with pix
                                    <img src="{{asset('pix.png')}}" alt="Pix"
                                        class="border border-gray-200 rounded-md shadow-sm h-7 dark:border-gray-600 -p-36">
                                </a>
                                @endif
                            </div>
                            @auth
                            <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                                :class="{ 'z-40': modalOpen }" class="relative w-auto h-auto">

                                <x-mary-button @click="modalOpen=true" class="w-full btn">
                                    <img src="{{ asset('pix.png') }}" alt="Pix" class="h-12 p-1 rounded-md shadow-sm">
                                    Pagar com Pix
                                </x-mary-button>
                                @else
                                <x-mary-button href="{{ route('login') }}" class="w-full btn">
                                    <img src="{{ asset('pix.png') }}" alt="Pix" class="h-12 p-1 rounded-md shadow-sm">
                                    Login to Checkout
                                </x-mary-button>
                                @endif
                                <template x-teleport="body">
                                    <div x-show="modalOpen" 0
                                        class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                        x-cloak>
                                        <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                            x-transition:leave="ease-in duration-300"
                                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                            @click="modalOpen=false"
                                            class="absolute inset-0 w-full h-full bg-white dark:bg-gray-900 backdrop-blur-sm bg-opacity-70 dark:bg-opacity-70">
                                        </div>
                                        <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                                            x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                                            class="relative w-full py-6 bg-white border shadow-lg dark:bg-gray-800 px-7 border-neutral-200 dark:border-gray-700 sm:max-w-lg sm:rounded-lg">
                                            <div class="flex items-center justify-between pb-3">
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Valor
                                                    a ser pago: R$ {{number_format($totalPrice, 2) }} </h3>
                                                <button @click="modalOpen=false"
                                                    class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="relative flex flex-col items-center justify-center gap-2 pb-8">
                                                <img class="rounded-lg shadow-xl" src="{{asset('piximage.png')}}" />

                                                <p class="mt-2 text-gray-800 dark:text-gray-300">Ou use nossa chave
                                                    pix:<strong>51995271903</strong></p>
                                                <p class="mt-2 text-gray-800 dark:text-gray-300">Após o pagamento,
                                                    clique no botão "Já paguei" e receberás brevemente um email com a
                                                    confirmação</p>
                                            </div>
                                            <div
                                                class="flex flex-col-reverse gap-1 sm:flex-row sm:justify-end sm:space-x-2">
                                                @if($cartItems->isEmpty())
                                                <x-mary-alert
                                                    title="Your cart is empty! Fill up you cart and then the payment buttons will appear"
                                                    class="alert-error" icon="o-exclamation-triangle" shadow />
                                                @else
                                                <x-mary-button @click="modalOpen=false" type="button" class="">Voltar
                                                </x-mary-button>
                                                <form action="{{ route('markAsPaid') }}" method="POST">
                                                    @csrf
                                                    <x-mary-button class="btn btn-success" type="submit">Já paguei
                                                    </x-mary-button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>



                            <div class="flex items-center justify-center gap-2">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                                <a href="{{route('components.shopping_cart_component_index')}}" title=""
                                    class="inline-flex items-center gap-2 text-sm font-medium underline text-primary-700 hover:no-underline dark:text-primary-500">
                                    Continue Compando
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

    </section>
    {{-- TOAST area --}}
    <x-mary-toast />
    @livewireScripts


</body>
