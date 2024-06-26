<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\product;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name'


    ];

    protected $primaryKey = 'category_id';

    public function products(): HasMany
    {
        return $this->hasMany(product::class, 'category_id');
    }
}
