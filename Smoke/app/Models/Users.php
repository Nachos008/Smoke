<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ['name', 'email', 'password'];

    public function games()
    {
        return $this->belongsToMany(Games::class, 'user_games', 'user_id', 'game_id')
        ->withPivot('purchased_at') 
        ->withTimestamps();
    }
}
