<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecoveryLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'user_id',
        'recovery_link'
    ];

    public function User():belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
