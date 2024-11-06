<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function Post(): belongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function SubCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
}
