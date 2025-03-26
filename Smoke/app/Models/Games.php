<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    //in database is: game_id, title, description, price, cover_image, created_at, publisher, developer, release_date, owned, pge_rating, review_score

    protected $fillable = ['title', 'description', 'price', 'cover_image', 'publisher', 'developer', 'release_date', 'owned', 'pge_rating', 'review_score'];    
}
