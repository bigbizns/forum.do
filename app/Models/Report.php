<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment_id',
        'reason',
        'message',
        'reported_user_id',
        'reported_comment',
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
