<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Mary\Traits\Toast;

class AddToCart extends Component
{
    use Toast; 

    public $productId;

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function addToCart()
    {
        if (!Auth::check()) {
           
            return redirect()->route('login');
        }

    
        $existingCartItem = ShoppingCart::where('user_id', Auth::id())
            ->where('product_id', $this->productId)
            ->first();

        if ($existingCartItem) {
         
            $existingCartItem->increment('quantity');
        } else {
          
            ShoppingCart::create([
                'user_id' => Auth::id(), 
                'product_id' => $this->productId,
                'quantity' => 1,
            ]);
        }

        $this->success(
            'Produto adicionado ao carrinho!', 
            'Seu produto foi adicionado com sucesso ao seu carrinho.', 
            position: 'toast-top toast-end', 
            timeout: 3000 
        );

      
        $this->dispatch('cartUpdated');
    }


    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
