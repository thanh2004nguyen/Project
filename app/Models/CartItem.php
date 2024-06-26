<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price'
    ];

    public function product()
    {
        return $this->belongsTo(product::class , 'product_id','product_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id','id');
    }

    public function total()
    {
        return $this->price * $this->quantity;
    }
}
