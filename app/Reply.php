<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['user_id', 'thread_id', 'body'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite($userId = null)
    {
        $attributes = ['user_id' => $userId ?? auth()->id()];

        if (!$this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->save(new Favorite($attributes));
        }
    }

    public function isFavorited()
    {
        return $this->favorites()->where('favorites.user_id', auth()->id())->exists();
    }
}
