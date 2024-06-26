<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'quantity',
    ];

    protected $primaryKey = 'waregouse_id';
    public function provider(): BelongsTo
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}
