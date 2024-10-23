<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostLike extends Model
{
    use HasFactory;

    protected $fillable =[
        'post_id',
        'user_id',
        'vote',
    ];

    public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Post(): belongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
