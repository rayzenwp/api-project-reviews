<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail',
        'body',
        'like_count',
        'user_id',
        'review_theme_id',
    ];

    public function reviewTheme(): BelongsTo
    {
        return $this->belongsTo(ReviewTheme::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
