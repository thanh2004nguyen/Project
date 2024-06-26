<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staticstical extends Model
{
    use HasFactory;
    protected $table = 'staticsticals';
    protected $fillable = [
        'order_date',
        'sales',
        'profit',
        'quantity',
        'total_order',
    ];
}
