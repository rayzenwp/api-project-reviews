<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Str;
use App\Models\ReviewTheme;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\Traits\ResponseTrait;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReviewController extends Controller
{
    use ResponseTrait;

    public function index(Request $request): AnonymousResourceCollection
    {
        $reviewTheme = $request->query('theme_code', null);
        $sortBy = (string)$request->query('sort_by', 'created_at');
        $sortOrder = (string)$request->query('sort_order', 'desc');

        $reviews = Review::query()->with('user', 'reviewTheme');

        if ($reviewTheme) {
            $reviews->whereHas('reviewTheme', function ($query) use ($reviewTheme) {
                $query->where('slug', $reviewTheme);
            });
        }
        $reviews = $reviews->orderBy($sortBy, $sortOrder)->paginate(10);
        $reviews = ReviewResource::collection($reviews);

        return $reviews;

    }

    public function show(Review $review): ReviewResource
    {
       return new ReviewResource($review);
    }

    public function store(ReviewRequest $request): JsonResponse
    {
        $user = User::where('name',$request->input('user_name'))->first();
        if (!$user) {
            $user = User::create([
                'name' => $request->input('user_name'),
                'password' => bcrypt('password')
            ]);
        }
        $theme = ReviewTheme::where('slug', $request->input('theme_code'))->first();
        if (!$theme) {
            return $this->respondWithCustomData(
                [
                'message' => 'Такої теми відгуків не має.',
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $imageUrl = Storage::disk('public')->url('/images/' . $imageName);
        }
        $review = Review::create([
            'body' => $request->input('body'),
            'like_count' => $request->input('like_count'),
            'thumbnail' => $imageUrl,
            'user_id' => $user->id,
            'review_theme_id' => $theme->id,
        ]);

        return $this->respondWithCustomData([
            new ReviewResource($review),
        ], JsonResponse::HTTP_CREATED);
    }

    public function update(ReviewRequest $request, Review $review): JsonResponse|ReviewResource
    {
        $user = User::where('name',$request->input('user_name'))->first();
        if (!$user) {
            $user = User::create([
                'name' => $request->input('user_name'),
                'password' => bcrypt('password')
            ]);
        }
        $theme = ReviewTheme::where('slug', $request->input('theme_code'))->first();
        if (!$theme) {
            return $this->respondWithCustomData(
                [
                'message' => 'Такої теми відгуків не має.',
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();
        $review->body = $data['body'];
        $review->like_count = isset($data['like_count']) ? ($review->like_count + $data['like_count']) : $review->like_count;
        $review->reviewTheme()->associate($theme);
        $review->user()->associate($user);
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $imageUrl = Storage::disk('public')->url('/images/' . $imageName);
            $review->thumbnail = $imageUrl;
        }
        $review->save();

        return new ReviewResource($review);
    }

    public function destroy(Review $review): JsonResponse
    {
        $review->delete();
        return $this->respondWithNoContent();
    }
}
