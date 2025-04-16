<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id', 'size', 'image', 'category'];



    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function setImageAttribute($value)
    {
        // If $value is already a JSON string, decode it to an array
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        // Ensure $value is an array and encode it as a JSON string
        $this->attributes['image'] = json_encode(array_values($value), JSON_UNESCAPED_SLASHES);
    }

    public function getImageAttribute($value)
    {
        // Decode the JSON string back to an array when accessing the attribute
        return json_decode($value, true);
    }

    protected $casts = [
        'image' => 'array',
    ];


    // Casting thhe image field to a array 
    //is unnecessary because you are storing a string, not a JSON array. Remove this casting to prevent conflicts.
}
