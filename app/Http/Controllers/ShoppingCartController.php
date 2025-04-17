<?php

namespace App\Http\Controllers;


use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class ShoppingCartController extends Controller
{

    public function updateSize(Request $request, $cartId)
    {
        // Validate the request
        $validated = $request->validate([
            'size' => 'required|string|in:P,M,G,GG',
        ]);

        // Find the cart item
        $cartItem = ShoppingCart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return redirect()->back()->with('error', [
                'title' => 'Item Not Found',
                'message' => 'This item is not in your cart.',
                'position' => 'top-end',
                'timeout' => 3000,
            ]);
        }

        // Update the size
        $cartItem->size = $validated['size'];
        $cartItem->save();

        return redirect()->back()->with('cart_message', [
            'title' => 'Size Updated',
            'message' => 'The size has been updated to ' . $validated['size'],
            'position' => 'top-end',
            'timeout' => 3000,
        ]);
    }

    public function markAsPaid(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para marcar um pedido como pago.');
        }

        $cartItems = ShoppingCart::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Seu carrinho está vazio.');
        }

        foreach ($cartItems as $item) {
            $order = new Order();
            $order->user_id = Auth::id(); // Ensure this field exists
            $order->name = $item->product->name;
            $order->quantity = $item->quantity;
            $order->size = $item->size ?? null; // Ensure size is available
            $order->status = 'under_process';
            $order->unit_price = $item->product->price * $item->quantity;
            $order->session_id = session()->getId();
            $order->save();

            // Remove item from cart after order creation
            $item->delete();
        }

        return redirect()->route('components.order-list-index')->with('success', 'Seu pedido foi registrado como pago.');
    }

    public function index(Request $request)
    {
        // Only retrieve cart items for the authenticated user
        $cartItems = ShoppingCart::where('user_id', Auth::id())->get();


        // TA DANDO ERRO NA BASE DE DADOS, ESTA PASSANDO NUMEROS AO INVES DO REAL NOME DO ESTADO, DESBUGAR DPS
        $brazilStates = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins',
        ];

        return view('components.list-cart', compact('cartItems', 'brazilStates'));
    }

    protected $casts = [
        'image' => 'array',
    ];

    public function debugImage($id)
    {
        $item = ShoppingCart::with('product')->findOrFail($id);
        dd($item->product->image);
        // dd($item->quantity); assim loga a quantity field of the shoppingcart database

    }

    public function increaseCartQuantity($productId)
    {
        $cartItem = ShoppingCart::where('product_id', $productId)
            ->where('user_id', auth()->id()) // Ensure this is scoped to the authenticated user
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        }

        return redirect()->back();
    }


    public function decreaseCartQuantity($productId)
    {
        $cartItem = ShoppingCart::where('product_id', $productId)
            ->where('user_id', auth()->id()) // Ensure this is scoped to the authenticated user
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
                $cartItem->save();
            } else {
                $cartItem->delete();
            }
        }

        return redirect()->back();
    }


    public function removeItemFromCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = ShoppingCart::where('user_id', Auth::id()) // Ensure this is scoped to the authenticated user
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->delete();

            return redirect()->back()->with('cart_message', [
                'title' => 'Item Removed',
                'message' => 'The item has been removed from your cart!',
                'position' => 'top-end',
                'timeout' => 3000,
            ]);
        }

        return redirect()->back()->with('error', [
            'title' => 'Item Not Found',
            'message' => 'This item is not in your cart.',
            'position' => 'top-end',
            'timeout' => 3000,
        ]);
    }


    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $cartItems = ShoppingCart::where('user_id', auth()->id())->with('product')->get();
        $lineItems = [];
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'brl',
                    'product_data' => [
                        'name' => $item->product->name,
                        'description' => strip_tags($item->product->description), // Remove HTML tags from description
                        'metadata' => [
                            'size' => $item->size, // Pass size as metadata
                            'quantity' => $item->quantity, // Pass quantity as metadata
                        ],
                    ],
                    'unit_amount' => $item->product->price * 100,
                ],
                'quantity' => $item->quantity,
            ];

            // Create the order for each cart item
            $order = new Order();
            $order->user_id = auth()->id(); // Assign the user ID
            $order->name = $item->product->name;
            $order->size = $item->size;
            $order->quantity = $item->quantity;
            $order->status = 'under_process';
            $order->unit_price = $item->product->price * $item->quantity;
            $order->save();
        }

        $session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.checkout-success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('payment.checkout-cancel', [], true),
        ]);

        return redirect($session->url);
    }


    public function success(Request $request)
    {

        return view('payment.checkout-success');
    }

    public function cancel(Request $request)
    {
        return view('payment.checkout-cancel');
    }
}
