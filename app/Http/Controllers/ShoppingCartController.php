<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Mary\Traits\Toast;
class ShoppingCartController extends Controller
{
    public function index()
    {
        $cartItems = ShoppingCart::with(['user', 'product'])->get();
        return view('components.list-cart', compact('cartItems'));
    }

    protected $casts = [
        'image' => 'array',
    ];

    public function debugImage($id)
{
    $item = ShoppingCart::with('product')->findOrFail($id);
    dd($item->product->image);
}

public function removeFromCart($id)
{
    $cartItem = ShoppingCart::find($id);

    if ($cartItem) {
        $cartItem->delete();
       

        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    return redirect()->back()->with('error', 'Item not found.');
}

//  <form action="{{ route('cart.debug', ['id' => $item->id]) }}" method="GET">
// <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
//   Debug Image
// </button>
// </form>
// to debug images and arrays
}