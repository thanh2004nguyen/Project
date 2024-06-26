<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class,'cart_id','id');
    }

    public static function fromSession()
    {
     
  
     
            $userId = auth()->id();
            $cart = Cart::whereHas('user', function($query) use ($userId) {
                $query->where('id', $userId);
            })->first();
        
        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->save();
        }
    
         
        return $cart;
    }


    public function addProduct($productId, $quantity = 1, $price)
    {
        $item = $this->items()->where('product_id', $productId)->first();
    
        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            $item = new CartItem([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price
            ]);
            $this->items()->save($item);
        }
    
        $this->update([
            'updated_at' => now()
        ]);
    }

    public function removeProduct(Product $product)
    {
        $this->items()->where('product_id', $product->product_id)->delete();
    }

    public function updateQuantity(Product $product, $quantity)
    {
        $item = $this->items()->where('product_id', $product->id)->first();
        if ($item) {
            $item->quantity = $quantity;
            $item->save();
        }
    }

    public function clear()
    {
        $this->items()->delete();
    }


    public function total()
{
    $total = 0;
    foreach ($this->items as $item) {
        $total += $item->price * $item->quantity;
    }
    return $total;
}

//     public function saveToSession()
// {
//     session()->put('cart.items', $this->items);
// }
}