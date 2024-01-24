<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Item;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request, $id)
    {
        $user = $request->user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('item_id', $id) 
            ->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('success', 'お気に入りを解除しました。');
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'item_id' => $id,
            ]);
            return redirect()->back()->with('success', 'お気に入りに追加しました。');
        }
    }

    public function showFavoriteList(Request $request)
    {
        $user = $request->user();
        $items = $user->favoriteItems();

        return view('favorites.index', compact('items'));
    }
}