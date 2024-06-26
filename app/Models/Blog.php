<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'Content',
        'user_id',
        'hagtag'

    ];

    protected $primaryKey = 'blog_id';


    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'blogComment_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(BlogImage::class, 'blog_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(BlogLike::class, 'blogLike_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
