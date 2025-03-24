<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    //in database is: game_id, title, description, price, cover_image, created_at, publisher, developer, release_date, owned, pge_rating, review_score

    //more to add (example): ALTER TABLE games ALTER TABLE games ADD COLUMN rating DECIMAL(3,1) NULL,ADD COLUMN genre VARCHAR(100) NULL,ADD COLUMN platform VARCHAR(100) NULL; 

}
