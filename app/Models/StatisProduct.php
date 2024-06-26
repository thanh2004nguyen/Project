<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisProduct extends Model
{
    protected $table = 'statisproducts';
    protected $fillable = [
        'date',
        'review',
        'sales_count',
        'product_id'
    ];
}
