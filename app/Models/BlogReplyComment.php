<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogReplyComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blogReplyComment_id',
        'Content',
        'user_id',
        'blogComment_id',

    ];

    protected $primaryKey = 'blogReplyComment';

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(BlogComment::class, 'blogComment_id');
    }
}
