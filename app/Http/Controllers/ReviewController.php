<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $reviews = $user->reviews;

            return response()->json($reviews, 200);
        } catch (Exception $e) {
            Log::error('Error fetching reviews: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch reviews'], 500);
        }
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'game_igdb_id' => 'required|integer|exists:games,igdb_id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255'
        ]);

        try {

            $review = Review::create([
                'user_id' => Auth::id(),
                'game_igdb_id' => $data['game_igdb_id'],
                'rating' => $data['rating'],
                'comment' => $data['comment'],
            ]);

            return response()->json(['message' => 'Review created successfully', 'data' => $review], 201);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $review = Review::findOrFail($id);  // Throws 404 if not found
            return response()->json($review, 200);
        } catch (Exception $e) {
            Log::error('Error fetching review: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch review'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string|max:500',
        ]);

        try {
            $review = Review::findOrFail($id);  // Find the review by ID

            // Check if the authenticated user is the owner of the review
            if ($review->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            // Update the review fields
            $review->update([
                'rating' => $data['rating'],
                'comment' => $data['comment'],
            ]);

            return response()->json(['message' => 'Review updated', 'review' => $review], 200);
        } catch (\Exception $e) {
            Log::error('Error updating review: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update review'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id);  // Find the review by ID

            // Check if the authenticated user is the owner of the review
            if ($review->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            // Delete the review
            $review->delete();

            return response()->json(['message' => 'Review deleted'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting review: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to delete review'], 500);
        }
    }

    public function getGameReviews($id)
    {
        $game = Game::where('igdb_id', $id)->firstOrFail();
        return response()->json($game->reviews, 200);
    }

    public function getUserReviews(Request $request)
    {
        $user = $request->user();
        return response()->json($user->reviews, 200);
    }
}

