<section class="relative overflow-x-hidden overflow-y-hidden bg-white isolate dark:bg-inherit md:px-0">
    <h3
        class="flex items-center gap-2 mx-4 mb-10 text-lg font-bold text-left text-gray-700 dark:text-gray-200 sm:mx-6 sm:text-3xl md:text-4xl lg:text-5xl sm:text-center">
        Lançamentos Brasileirão
        <span
            class="inline-flex items-center justify-center px-3 py-2 mx-1 text-xs font-medium text-green-700 rounded-md bg-green-50 dark:bg-green-200 ring-1 ring-green-600/20 dark:ring-green-500 ring-inset">
            Frete grátis no Brasil
        </span>
    </h3>

    <div class="px-4 mx-auto sm:px-12 xl:px-5">
        <swiper-container pagination="true" navigation="true" loop="true" slides-per-view="1" space-between="20"
            breakpoints='{
                "480": { "slidesPerView": 1, "spaceBetween": 10 },
                "640": { "slidesPerView": 2, "spaceBetween": 10 },
                "768": { "slidesPerView": 3, "spaceBetween": 15 },
                "1024": { "slidesPerView": 4, "spaceBetween": 20 },
                "1280": { "slidesPerView": 5, "spaceBetween": 20 },
                "1536": { "slidesPerView": 6, "spaceBetween": 20 }
            }'>
            @forelse($products as $product)
            <swiper-slide class="mb-10">
                <!-- Card Container -->
                <div
                    class="relative flex flex-col h-auto text-sm rounded-lg shadow-md xl:h-full dark:bg-gray-800 bg-gray-50">
                    <span
                        class="absolute z-10 inline-flex items-start gap-1 px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-md top-2 left-2 ring-1 ring-yellow-400 dark:ring-yellow-600 ring-inset"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-3 mt-[2px]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                        </svg> 21%</span>
                    @php
                    $imageArray = is_string($product->image) ? json_decode($product->image, true) : $product->image;
                    $firstImage = !empty($imageArray) && is_array($imageArray) ? $imageArray[0] : 'default.jpg';
                    @endphp

                    <div class="relative w-full h-auto rounded-md">
                        <img data-src="{{ asset('storage/' . ($firstImage ?? 'default.jpg')) }}"
                            alt="{{ $product->name }}"
                            class="w-full transition-opacity duration-300 rounded-md h-72 lazy-image" loading="lazy" />
                        <span
                            class="absolute z-10 inline-flex items-start gap-1 px-2 py-1 text-xs font-medium text-green-600 bg-green-100 rounded-md right-2 bottom-2 text-start dark:text-green-500 ring-1 ring-green-600/20 ring-inset">
                            <x-mary-icon name="o-truck" class="w-4 h-4" />
                            <span>Frete grátis</span>
                        </span>
                        <!-- Placeholder -->
                        <div
                            class="absolute top-0 left-0 flex items-center justify-center w-full h-full transition-opacity duration-300 bg-white rounded-t-md dark:bg-gray-800 placeholder">
                            <span class="loader">
                                <div role="status"
                                    class="flex flex-col items-center justify-center w-56 h-56 bg-gray-300 rounded-lg sm:h-72 md:w-56 sm:w-72 sm:rounded-t-lg animate-pulse dark:bg-gray-700">
                                    <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                        <path
                                            d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                        <path
                                            d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM9 13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2Zm4 .382a1 1 0 0 1-1.447.894L10 13v-2l1.553-1.276a1 1 0 0 1 1.447.894v2.764Z" />
                                    </svg>
                                    <small class="text-gray-500 dark:text-gray-300">Imagem carregando...</small>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </span>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="flex flex-col flex-grow p-5">
                        <!-- Product Name -->
                        <a href="#">
                            <h5
                                class="mb-2 text-sm font-bold tracking-tight text-gray-900 xl:text-base dark:text-white">
                                {{ Str::words($product->name, 20, '...') }}</h5>
                        </a>

                        <!-- Product Description -->
                        <p class="mb-3 text-sm text-gray-700 dark:text-gray-400 line-clamp-2">
                            {{ Str::words(strip_tags($product->description), 2, '...') }}
                        </p>

                        <!-- Price -->
                        <div class="gap-1 mb-1">
                            <p class="text-sm font-semibold text-green-500 dark:text-green-600">R$ {{$product->price}}
                                <span class="mt-1 text-xs text-gray-400 dark:text-gray-600"><del>R$ 159.99</del></span>
                            </p>
                        </div>

                        <!-- Installment -->
                        <div class="flex items-center gap-1 mb-2 text-sm">
                            <p class="text-sm">Ou <strong>12x</strong> de <span
                                    class="text-sm font-semibold text-green-500 dark:text-green-600">R$ 15,24</span></p>
                        </div>

                        <!-- Button -->
                        <a href="{{ route('components.shopping_cart_component_index') }}" class="relative"
                            x-data="{ loading: false }" @click.prevent="
                               loading = true;
                               setTimeout(() => {
                                   window.location.href = $el.getAttribute('href');
                               }, 250);
                           ">
                            <span x-show="!loading">
                                <x-mary-button icon="o-shopping-bag" label="Ver mais"
                                    class="w-full btn-success btn btn-soft" />
                            </span>
                            <span x-show="loading" x-cloak>
                                <x-mary-button class="relative w-full btn">
                                    <x-mary-loading class="text-gray-500 dark:text-gray-500" />
                                </x-mary-button>
                            </span>
                        </a>
                    </div>
                </div>
            </swiper-slide>
            @empty
            <!-- Placeholder when no products are available -->
            <div class="w-full py-10 text-center">
                <p class="text-lg text-gray-500 dark:text-gray-400">Nenhum produto disponível no momento.</p>
            </div>
            @endforelse
        </swiper-container>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const images = document.querySelectorAll(".lazy-image"); // Select all images
                const placeholders = document.querySelectorAll(".placeholder"); // Select all placeholders

                images.forEach((img, index) => {
                    const placeholder = placeholders[index]; // Get corresponding placeholder

                    // Artificial 2-second delay before the image starts loading
                    setTimeout(function() {
                        img.src = img.getAttribute('data-src'); // Start loading the image after delay
                    }, 2000);

                    img.addEventListener("load", function () {
                        placeholder.style.opacity = "0"; // Smooth fade-out effect
                        setTimeout(() => {
                            placeholder.style.display = "none"; // Remove the placeholder after fade-out
                        }, 300);
                    });

                    // If the image is already cached, trigger the load event manually after delay
                    if (img.complete) {
                        setTimeout(() => {
                            img.dispatchEvent(new Event("load"));
                        }, 2000);
                    }
                });
            });
        </script>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
</section>