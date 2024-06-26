<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogComment extends Model
{
    use HasFactory;


    protected $fillable = [
        'blogComment_id',
        'Content',
        'user_id',
        'blog_id'

    ];

    protected $primaryKey = 'blogComment_id';


    public function replyComment(): HasMany
    {
        return $this->hasMany(BlogReplyComment::class, 'blogReplyComment_id');
    }

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
