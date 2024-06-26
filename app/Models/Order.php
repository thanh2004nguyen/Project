<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
    	'customer_id','order_date', 'shipping_id', 'order_status','order_code','created_at','payment_content','usedvoucher'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'orders';

    public function orderdetail(){
        return $this->hasMany(OrderDetail::class,'order_id','order_id');
    }

  
}
