<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\Url;

new class extends Component {

    public ?int $category_id = null;

public function updatedCategoryId($value)
{
    $this->category_id = $value;
}

public function categories()
{
    return Category::all();
}

public function products()
{
    $query = Product::query();

    if ($this->category_id) {
        $query->where('category_id', $this->category_id);
    }

    return $query->get();
}

    public function with(): array
    {
        return [
            'categories' => $this->categories(),
            'products' => $this->products(),
          
        ];
    }
}; ?>

<div >
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
    </style>
    <x-mary-header title="Camisas" />

    <x-mary-header size="text-inherit" progress-indicator>
        {{-- SEARCH --}}
        <x-slot:title id="buceta">

            <!-- Replace the input with the choices component -->
            <x-mary-choices
                label="Select Products"
                wire:model.live="selected_product_ids"
            
                placeholder="Digite algo"
                search-function="searchProducts"
                no-result-text="No products found"
                searchable
                multiple
                class="md:w-96 w-full border-warning text-warning" />
        </x-slot:title>

        {{-- SORT --}}
        <x-slot:actions class="mt-7">
             <x-mary-dropdown label="Seleções" class="btn-sm">
        @foreach($categories as $category)
            <x-mary-menu-item wire:click="$set('category_id', {{ $category->id }})" title="{{ $category->name }}" />
        @endforeach
        <x-mary-menu-item wire:click="$set('category_id', null)" title="Todos" />
    </x-mary-dropdown>
    
            <x-mary-dropdown label="Times Europeus" class="btn-sm">
                <x-mary-menu-item value="liga_alema" title="Liga Alemã" />
                <x-mary-menu-item value="liga_espanhola" title="Liga Espanhola"  /> 
                <x-mary-menu-item value="liga_francesa" title="Liga Francesa"  />
                <x-mary-menu-item value="liga_inglesa"  title="Liga Ingles"/>
                <x-mary-menu-item value="todos"  title="Todos"  />
            </x-mary-dropdown>
           
        </x-slot:actions>
    </x-mary-header>

    <div class="mt-10 !p-0 sm:!p-2">
        {{-- PRODUCTS LIST --}}
        <div  class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
                <div class="product-card" data-category="{{ $product->category_id }}">
                    <x-mary-card title="{{ $product->name }}" class="dark:bg-gray-800 bg-gray-50 text-sm relative shadow-md">
                        <x-slot:figure>
                            <img src="{{ asset('storage/' . ($product->image[0] ?? 'default.jpg')) }}" class="h-72 w-full" alt="{{ $product->name }}" />
                        </x-slot:figure>
                        <p class="text-lg font-semibold">R$ {{ $product->price }}</p>
                        <a class="btn w-full mt-5 btn-warning" href="{{ route('product.show', $product->id) }}">Ver mais</a>
                    </x-mary-card>
                </div>
            @endforeach
        </div>
    </div>
   
   
</div>