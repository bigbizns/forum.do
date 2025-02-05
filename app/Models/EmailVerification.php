<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailVerification extends Model
{
    use HasFactory;

    protected $table = 'email_verification_links';

    protected $fillable = [
        'email',
        'user_id',
        'code',
    ];

    public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
