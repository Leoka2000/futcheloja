<?php
use App\Models\Product;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {

    use WithPagination;
    public string $selectedCategory = 'todos';
    public string $searchTerm = ''; // Search input

    public function products()
    {
        $query = Product::query();

        // Apply category filter
        if ($this->selectedCategory !== 'todos') {
            $query->where('category', $this->selectedCategory);
        }

        // Apply search filter for product name
        if (!empty($this->searchTerm)) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }

        return $query->paginate(6);
    }

    public function setFilter($category)
    {
        $this->searchTerm = ''; // Clear search term when category changes
        $this->selectedCategory = $category;
    }

    public function searchMulti($search)
    {
        $this->searchTerm = $search;
    }

    public function clear()
    {
        $this->selectedCategory = 'todos';
        $this->searchTerm = '';
    }

    public function with(): array
    {
        return [
            'products' => $this->products(),
            'selectedCategory' => $this->selectedCategory,
            'searchTerm' => $this->searchTerm
        ];
    }
    public function placeholderForImage()
    {
        return <<<'HTML'

           <span class="loader"></span>

        HTML;
    }
};

?>

<div x-data="{ searchTerm: @entangle('searchTerm') }">

    <style>
        .pb-5>div>div>div {
            font-size: 1rem;
        }

        .bg-base-200>div>div>svg {
            color: black !important;
        }

        #mary0b633c6213a280630d87862878f46b16search {
            border-color: oklch(var(--wa));
            background-color: transparent;
        }

        #mary0b633c6213a280630d87862878f46b16search:focus {
            outline: 2px solid oklch(var(--wa)) !important;
            /* Adjust the thickness as needed */
            outline-offset: 2px !important;
        }

        .selectcustomcss:focus {
            outline: 2px solid oklch(var(--wa)) !important;
            /* Adjust the thickness as needed */
            outline-offset: 2px !important;
        }

        .end-8 {
            display: none;

        }

        .outline-none {
            width: 5rem;
            border-radius: 0.5rem;
            border-color: transparent;

        }
    </style>
    <x-mary-header title="Camisas" />
    <a href="{{ route('livewire.components.hero') }}" x-data="{ loading: false }"
        @click.prevent="loading = true; setTimeout(() => window.location.href = $el.href, 200)">
        <x-mary-button icon="o-arrow-uturn-left" class="w-full mb-10 btn md:w-96">Voltar </x-mary-button>
    </a>

    <x-mary-header size="text-inherit" progress-indicator>
        {{-- SEARCH --}}
        <x-slot:title>
            <x-mary-choices label="Procure camisas" placeholder="Digite para procurar..." search-function="searchMulti"
                no-result-text="Ops! Nada aqui..." searchable class="ml-4 sm:w-full lg:w-96 border-warning text-warning"
                x-model="searchTerm" wire:model="clear" />
        </x-slot:title>

        {{-- SORT --}}
        <x-slot:actions class="flex flex-wrap gap-2 mt-7">
            <x-mary-dropdown label="Times Europeus" class="w-full btn-sm md:w-auto">
                <x-mary-menu-item @click.stop value="liga_alema" title="Liga Alemã" wire:click="setFilter('liga_alema')"
                    wire:click.stop="setFilter('liga_alema')" spinner="setFilter('liga_alema')" />
                <x-mary-menu-item @click.stop value="liga_espanhola" title="Liga Espanhola"
                    wire:click="setFilter('liga_espanhola')" spinner="setFilter('liga_espanhola')" />
                <x-mary-menu-item @click.stop value="liga_francesa" title="Liga Francesa"
                    wire:click="setFilter('liga_francesa')" spinner="setFilter('liga_francesa')" />
                <x-mary-menu-item @click.stop value="liga_inglesa" title="Liga Inglesa"
                    wire:click="setFilter('liga_inglesa')" spinner="setFilter('liga_inglesa')" />
                <x-mary-menu-item @click.stop value="todos" title="Todos" wire:click="setFilter('todos')"
                    spinner="setFilter('todos')" />
            </x-mary-dropdown>

            {{-- National Teams --}}
            <x-mary-dropdown label="Seleções" class="w-full btn-sm md:w-auto">
                <x-mary-menu-item @click.stop value="america" title="América" wire:click="setFilter('america')"
                    spinner="setFilter('america')" />
                <x-mary-menu-item @click.stop value="europa" title="Europa" wire:click="setFilter('europa')"
                    spinner="setFilter('europa')" />
                <x-mary-menu-item @click.stop value="asia" title="Ásia" wire:click="setFilter('asia')"
                    spinner="setFilter('asia')" />
                <x-mary-menu-item @click.stop value="africa" title="África" wire:click="setFilter('africa')"
                    spinner="setFilter('africa')" />
                <x-mary-menu-item @click.stop value="todos" title="Todos" wire:click="setFilter('todos')"
                    spinner="setFilter('todos')" />
            </x-mary-dropdown>

            {{-- Brazilian Teams --}}
            <x-mary-dropdown label="Times Brasileiros" class="w-full btn-sm md:w-auto">
                <x-mary-menu-item @click.stop value="cariocas" title="Cariocas" wire:click="setFilter('cariocas')"
                    spinner="setFilter('cariocas')" />
                <x-mary-menu-item @click.stop value="paulistas" title="Paulistas" wire:click="setFilter('paulistas')"
                    spinner="setFilter('paulistas')" />
                <x-mary-menu-item @click.stop value="sulistas" title="Sulistas" wire:click="setFilter('sulistas')"
                    spinner="setFilter('sulistas')" />
                <x-mary-menu-item @click.stop value="mineiros" title="Mineiros" wire:click="setFilter('mineiros')"
                    spinner="setFilter('mineiros')" />
                <x-mary-menu-item @click.stop value="nordestinos" title="Nordestinos"
                    wire:click="setFilter('nordestinos')" spinner="setFilter('nordestinos')" />
                <x-mary-menu-item @click.stop value="todos" title="Todos" wire:click="setFilter('todos')"
                    spinner="setFilter('todos')" />
            </x-mary-dropdown>
        </x-slot:actions>
    </x-mary-header>

    <div class="mt-10 !p-0 sm:!p-2">
        {{-- PRODUCTS LIST --}}
        @if($products->hasPages())
        <div class="flex justify-start w-full col-span-2 mt-8 mb-5 md:col-span-4 xl:col-span-6">
            <div class="join">
                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                <input class="join-item btn btn-square" type="radio" name="options" aria-label="{{ $page }}"
                    wire:click="gotoPage({{ $page }})" @if($products->currentPage() === $page)
                checked="checked" class="btn-warning"
                @endif />
                @endforeach
            </div>
        </div>
        @endif
        <div x-data class="grid grid-cols-2 gap-4 md:grid-cols-4 xl:grid-cols-6">
            @forelse($products as $product)

            <x-mary-card wire:key="product-{{ $product->id }}" title="{{ Str::words($product->name,20, '...') }}"
                class="relative text-sm shadow-md dark:bg-gray-800 bg-gray-50">
                <span
                    class="absolute inline-flex items-start gap-1 px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-md top-2 left-2 ring-1 ring-yellow-400 dark:ring-yellow-600 ring-inset"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-3 mt-[2px]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                    </svg> 21%</span>

                <x-slot:figure class="relative">

                    <div x-data="{ loaded: false }" class="relative w-full h-auto rounded-md">
                        <!-- Loading Placeholder -->
                        <div x-show="!loaded"
                            class="absolute inset-0 flex items-center justify-center bg-gray-200 rounded-md animate-pulse">
                            <div
                                class="flex items-center justify-center w-full h-full mb-4 bg-gray-300 rounded-sm dark:bg-gray-700">
                                <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path
                                        d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                </svg>
                            </div>
                        </div>

                        @php
                        $imageArray = is_string($product->image) ? json_decode($product->image, true) : $product->image;

                        // Ensure $imageArray is an array before accessing index 0
                        $firstImage = !empty($imageArray) && is_array($imageArray) ? $imageArray[0] : 'default.jpg';
                        @endphp

                        <div x-data="{ loaded: false }" class="relative w-full h-auto rounded-md">
                            <img src="{{ asset('storage/' . ($product->image[0] ?? 'default.jpg')) }}"
                                class="w-full h-72" alt="{{ $product->name }}"
                                class="w-full h-auto transition-opacity duration-300 rounded-md" x-ref="lazyImage"
                                loading="lazy" @load="loaded = true" />
                            <div class='absolute top-0 right-0 w-full h-full' x-show="!loaded" x-cloak>
                                {!! $this->placeholderForImage() !!}
                            </div>
                        </div>

                        <!-- Badge -->
                        <span
                            class="absolute inline-flex items-start gap-1 px-2 py-1 text-xs font-medium text-green-600 bg-green-100 rounded-md bottom-2 right-2 text-start dark:text-green-500 ring-1 ring-green-600/20 ring-inset">
                            <x-mary-icon name="o-truck" class="w-4 h-4" />
                            <span>Frete grátis</span>
                        </span>
                    </div>
                </x-slot:figure>
                <div class="gap-1 mb-1">
                    <p class="text-sm font-semibold text-green-500 dark:text-green-600">R$ {{$product->price}} <span
                            class="mt-1 text-xs text-gray-400 dark:text-gray-600 "> <del>R$ 159.99 <del></span></p>
                </div>
                <div class="flex items-center gap-1">
                    <p class="text-sm">Ou <strong>12x</strong> de <span
                            class="font-semibold text-green-500 dark:text-green-600">R$ 15,24</span></p>
                </div>
                <x-slot:menu>

                </x-slot:menu>
                <div>
                    <x-mary-button x-data="{ loading: false }" x-bind:class="{'cursor-not-allowed opacity-50': loading}"
                        x-on:click.prevent="loading = true; window.location.href = '{{ route('product.show', $product->id) }}';"
                        class="w-full mt-5 btn-success btn btn-soft">
                        <x-mary-icon x-show=" !loading" name="o-cursor-arrow-rays" class="w-5 md:w-6" />
                        <span x-show="!loading">Detalhes</span>
                        <x-mary-loading class="text-gray-700 dark:text-gray-400" x-show="loading" x-cloak />
                    </x-mary-button>


                </div>

            </x-mary-card>


            @empty
            {{-- NO RESULTS--}}
            <div class="lg:w-screen lg:max-w-2xl">
                <x-mary-alert title="Nada aqui!" description="Tente remover alguns filtros."
                    icon="o-exclamation-triangle" class="border-none bg-base-100">
                    <x-slot:actions>
                        <x-mary-button label="Limpar filtros" wire:click="clear" icon="o-x-mark" spinner />
                    </x-slot:actions>
                </x-mary-alert>
            </div>
            @endforelse

        </div>
    </div>


</div>