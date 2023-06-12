<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Review;
use App\Models\ReviewTheme;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        if (!Storage::directoryMissing('public/images')) {
            Storage::createDirectory('public/images');
        }

        $image = $this->faker->image(Storage::path('public/images'), 640, 480, 'food');
        $dir = storage_path('app/public/images/');
        $imageName = basename($image);

        Storage::move($image, $dir . $imageName);

        return [
            'body' => $this->faker->paragraph(),
            'thumbnail' => url('/storage/images/' . $imageName),
            'like_count' => $this->faker->numberBetween(0, 100),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'review_theme_id' => ReviewTheme::query()->inRandomOrder()->value('id'),
        ];

    }
}
