<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'tradeAction',
        'description',
        'pinned'
    ];

    public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Comment(): HasMany
    {
        return $this->HasMany(Comment::class);
    }
    public function PostLike(): HasMany
    {
        return $this->HasMany(PostLike::class);
    }
}
