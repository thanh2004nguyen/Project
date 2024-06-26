<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
    	'order_id', 
        'product_id', 
        'product_name',
        'product_price',
        'product_quantity',
        'product_coupon',
        'product_feeship'
    ];
    protected $primaryKey = 'orderDetail_id';
    protected $table = 'order_details';
    public function product(){
        return $this->belongsTo(Product::class,'product_id','product_id');
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id','order_id');
    }

    public function review(){
        return $this->hasOne(Review::class,'orderdetail_id','orderdetail_id');
    }

}
