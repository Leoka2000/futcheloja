<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    #show eh a funcsao que passamsos no web.php----


    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.show', compact('product'));
    }
}
