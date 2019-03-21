<?php

namespace App;

use App\Filters\Filters;
use App\Filters\ThreadFilters;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use Filterable;

    protected $fillable = ['user_id', 'channel_id', 'title', 'body'];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function path()
    {
        return '/threads/' . $this->channel->slug . '/' . $this->id;
    }
}
