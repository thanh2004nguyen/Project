<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
    ];


    public function product()
    {
        return $this->belongsTo(product::class,'product_id','product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function order_details()
    {
        return $this->hasOne(OrderDetail::class,'orderdetail_id','orderdetail_id');
    }
}
