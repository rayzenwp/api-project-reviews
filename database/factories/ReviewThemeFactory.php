<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Review;
use App\Models\ReviewTheme;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewThemeFactory extends Factory
{
    protected $model = ReviewTheme::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->name(),
            'name' => $this->faker->name(),
        ];


    }
}
