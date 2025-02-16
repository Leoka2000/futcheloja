<?php

use Livewire\Volt\Component;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    
    public $cartCount = 0;

    protected $listeners = [
        'cartUpdated' => 'updateCartCount',
    ];

    public function mount(){
        $this->updateCartCount();
    }

    public function updateCartCount(){
        // Get the count from the shopping cart table
        $this->cartCount = ShoppingCart::where('user_id', Auth::id())->sum('quantity');
    }

}; ?>

<div>
    <x-mary-badge value="{{ $cartCount }}" class="badge-warning indicator-item absolute -right-2 -top-2" />
</div>