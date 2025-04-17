<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartForm extends Component
{
    public $brazilStates = [];
    public $email, $first_name, $last_name, $address, $address2, $city, $selectedState, $zipcode, $phone;
    public $selectedSize = []; // To store selected sizes for each item

    protected $rules = [
        'email' => 'required|email|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'address2' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
        'selectedState' => 'required|string|max:255',
        'zipcode' => 'required|string|max:10',
        'phone' => 'required|string|max:15',
    ];

    public function mount($brazilStates)
    {
        $this->brazilStates = $brazilStates;

        // Initialize selected sizes from cart items
        $cartItems = ShoppingCart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            $this->selectedSize[$item->id] = $item->size;
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        $this->validate();

        Customer::create([
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'address2' => $this->address2,
            'city' => $this->city,
            'province' => $this->selectedState,
            'zipcode' => $this->zipcode,
            'phone' => $this->phone,
            'status' => 'active',
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'Cadastro realizado com sucesso!');
        return redirect()->route('components/list-cart');
    }

    public function updateSize($cartId, $size)
    {
        // Validate the size
        if (!in_array($size, ['P', 'M', 'G', 'GG'])) {
            $this->dispatch('cart_message', [
                'title' => 'Error',
                'message' => 'Invalid size selected',
                'position' => 'top-end',
                'timeout' => 3000,
            ]);
            return;
        }

        // Find the cart item
        $cartItem = ShoppingCart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            $this->dispatch('error', [
                'title' => 'Item Not Found',
                'message' => 'This item is not in your cart.',
                'position' => 'top-end',
                'timeout' => 3000,
            ]);
            return;
        }

        // Update the size
        $cartItem->size = $size;
        $cartItem->save();

        // Update the local selectedSize property
        $this->selectedSize[$cartId] = $size;

        $this->dispatch('cart_message', [
            'title' => 'Size Updated',
            'message' => 'The size has been updated to ' . $size,
            'position' => 'top-end',
            'timeout' => 3000,
        ]);
    }

    public function render()
    {
        return view('livewire.shopping-cart-form');
    }
}
