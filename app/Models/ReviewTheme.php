<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewTheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
