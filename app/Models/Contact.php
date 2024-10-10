<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $table = 'contact_us';

    use HasFactory;

    protected $fillable = [
        'email',
        'user_id',
        'topic',
        'message'
    ];

    public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
