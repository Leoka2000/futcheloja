<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;

Route::get('/', function () {
    return view('livewire.components.hero');
});


Route::view('/', 'livewire.components.hero')
    ->name('livewire.components.hero');


Route::get('/cart/debug/{id}', [ShoppingCartController::class, 'debugImage'])->name('cart.debug');

Route::delete('/cart/remove/{productId}', [ShoppingCartController::class, 'removeItemFromCart'])->name('cart.remove');
Route::post('/cart/increase/{productId}', [ShoppingCartController::class, 'increaseCartQuantity'])->name('cart.increase');
Route::post('/cart/decrease/{productId}', [ShoppingCartController::class, 'decreaseCartQuantity'])->name('cart.decrease');
Route::put('/cart/update-size/{cartId}', [ShoppingCartController::class, 'updateSize'])->name('cart.updateSize');
Route::post('/mark-as-paid', [ShoppingCartController::class, 'markAsPaid'])->name('markAsPaid');
//checkout method h ere(checkoutfunction)
Route::get('/checkout', [ShoppingCartController::class, 'checkout'])->name('checkout');
Route::get('/success', [ShoppingCartController::class, 'success'])->name('payment.checkout-success');
Route::get('/cancel', [ShoppingCartController::class, 'cancel'])->name('payment.checkout-cancel');
Route::post('/webhook', [ShoppingCartController::class, 'webhook'])->name('checkout.webhook');


Route::view('catalogo', 'livewire.components.shopping_cart_component_index')
    ->name('components.shopping_cart_component_index');

Route::view('minhas-compras', 'livewire.components.order-list-index')
    ->name('components.order-list-index');

Route::view('termos-e-servicos', 'policy')
    ->name('policy');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/shopping-cart', [ShoppingCartController::class, 'index'])->middleware(['auth'])->name('components/list-cart');

Route::get('/cart-list', function () {
    return view('cart-list'); // This Blade view will include the Livewire component
})->name('cart-list');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
