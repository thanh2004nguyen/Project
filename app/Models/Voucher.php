<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';

    protected $fillable = [
        'code',
        'user_id',
        'expiration_date',
        'is_used',
        'type',
        'discount',
        'discounttype',
        'name'
    ];

    protected $dates = [
        'expiration_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
