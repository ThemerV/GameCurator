<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PlaylistController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $playlists = $user->playlists;

            return response()->json($playlists, 200);
        } catch (Exception $e) {
            Log::error('Error fetching playlists: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch playlists'], 500);
        }
    }

    public function show($id)
    {
        try {
            $playlist = Playlist::findOrFail($id);
            return response()->json($playlist, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Playlist not found'], 404);
        } catch (Exception $e) {
            Log::error('Error fetching playlist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to fetch playlist'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:32',
                'description' => 'nullable|string|max:255',
                'games_array' => 'nullable|array',
            ]);

            $user = $request->user();

            $playlist = Playlist::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'games_array' =>  $data['games_array'],
                'description' => $data['description'],
            ]);

            return response()->json($playlist, 201);
        } catch (Exception $e) {
            Log::error('Error creating playlist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create playlist'], 500);
        }
    }

    public function update(Request $request, Playlist $playlist)
    {
        try {
            $user = $request->user();

            if ($user->id != $playlist->user_id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $data = $request->validate([
                'name' => 'string|max:32',
                'description' => 'string|max:255',
            ]);

            $playlist->name = $data['name'];
            $playlist->description = $data['description'];
            $playlist->update();

            return response()->json(['message' => 'Playlist updated successfully', $playlist], 200);
        } catch (Exception $e) {
            Log::error('Error updating playlist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to update playlist'], 500);
        }
    }

    public function addGame(Request $request, Playlist $playlist)
    {
        try {
            $user = $request->user();
            if ($user->id != $playlist->user_id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $data = $request->validate([
                'game_id' => 'required|integer|exists:games,igdb_id',
            ]);

            $games = $playlist->games_array ?? [];

            if (in_array($data['game_id'], $games)) {
                return response()->json(['message' => 'Game already in playlist'], 400);
            }
            $games[] = $data['game_id'];
            $playlist->games_array = $games;
            $playlist->save();

            return response()->json([
                'message' => 'Game added to playlist',
                'playlist' => $playlist,
            ]);

        } catch (Exception $e) {
            Log::error('Error adding game to playlist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to add game to playlist'], 500);
        }
    }


    public function removeGame(Request $request, Playlist $playlist)
    {
        try {
            $user = $request->user();
            if ($user->id != $playlist->user_id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $data = $request->validate([
                'game_id' => 'required|exists:games,igdb_id',
            ]);

            $games = $playlist->games_array ?? [];
            if (!in_array($data['game_id'], $games)) {
                return response()->json(['message' => 'Game not found in playlist'], 404);
            }

            $games = array_diff($games, [$data['game_id']]);
            $playlist->games_array = array_values($games); // Re-index the array
            $playlist->save();

            return response()->json([
                'message' => 'Game removed from playlist',
                'playlist' => $playlist,
            ]);

            return response()->json(['message' => 'Game removed from playlist']);
        } catch (Exception $e) {
            Log::error('Error removing game from playlist: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to remove game from playlist'], 500);
        }
    }

    public function destroy(Request $request, Playlist $playlist)
    {
        $user = $request->user();

        if ($user->id != $playlist->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $playlist->delete();

        return response()->json(['message' => 'Playlist deleted successfully'], 200);
    }
}
