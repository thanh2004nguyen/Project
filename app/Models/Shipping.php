<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
    	  'shipping_name',
          'shipping_address',
          'shipping_phone',
          'shipping_email',
          'shipping_notes',
          'shipping_dictrictId',
          'shipping_wardId',
          'shipping_address_street',
          'shipping_method'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'shippings';

     public function user()
     {
         return $this->belongsTo(Product::class,'user_id','id');
     }
}
