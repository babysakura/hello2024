<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'item_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function isFavoritedBy($userId, $itemId)
    {
        return $this->where('user_id', $userId)
            ->where('item_id', $itemId)
            ->exists();
    }
}
