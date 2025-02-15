<x-guest-layout>
    <section class="px-2 py-20 container relative isolate   bg-white dark:bg-inherit md:px-0" x-data="{ loading: false }">
        <div class="absolute top-0 left-1/2 -z-10 -translate-x-1/2 blur-[5rem] xl:-top-6 opacity-70 animate-blur-move" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#facc15] to-[#4ade80]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>


        <style>
            @keyframes blurMove {
                0% {
                    transform: translateX(-50%) translateY(0) scale(1);
                    opacity: 0.7;
                }

                50% {
                    transform: translateX(-55%) translateY(-120px) scale(0.6);
                    opacity: 0.5;
                }

                100% {
                    transform: translateX(-50%) translateY(0) scale(1);
                    opacity: 0.7;
                }
            }

            .animate-blur-move {
                animation: blurMove 8s infinite ease-in-out;
            }
        </style>
        <div class="items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div class="w-full pb-6 space-y-6 sm:max-w-md lg:max-w-lg md:space-y-4 lg:space-y-8 xl:space-y-9 sm:pr-5 lg:pr-0 md:pb-0">
                        <h1 class="text-4xl font-extrabold tracking-tight dark:text-gray-200 text-gray-800 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl">
                            <div class="flex justify-start items-center gap-4"><span class="block xl:inline">Futchê</span> <img class="h-10 w-10 mt-1 rounded-full" src="{{asset('bandeira.png')}}" /> </div>
                            <span class="block xl:inline"><span class="text-yellow-400">Seja</span><span class="dark:text-green-500 text-green-600"> Bem</span> <span class="dark:text-red-500 text-red-600">Vindo! </span> </span>
                        </h1>
                        
                        <p class="mx-auto text-base dark:text-gray-200 text-gray-900 sm:max-w-md lg:text-xl md:max-w-3xl"> Para ter acesso ao catálogo, clique no botão abaixo e confira nossas peças Exclusivas </p>
                        <div class="relative flex flex-col sm:flex-row sm:space-x-4">
                            
                            <a
                                @click="
        loading = true;
        setTimeout(() => {
            window.location.href = '{{ route('components.shopping_cart_component_guest') }}'; 
        }, 1000);"
                                class="btn w-full customcssbtn btn-warning  mt-5 flex items-center justify-center"
                                :disabled="loading">
                                <span x-show="!loading">Ver mais</span>
                                <span x-show="loading">
                                    <x-mary-loading class="text-gray-700 dark:text-gray-400 " x-show="loading" />
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full overflow-hidden flex justify-center rounded-md shadow-sm sm:rounded-xl" data-rounded="rounded-xl" data-rounded-max="rounded-full">
                        <img class="object-cover w-60" src="{{asset('logobig.png')}}">
                        <img class="object-cover w-60" src="{{asset('cristiano.png')}}">
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>