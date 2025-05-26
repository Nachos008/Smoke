<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    //in database is: game_id, title, description, price, cover_image, created_at, publisher, developer, release_date, owned, pge_rating, review_score, base_game_tag, tags, critic_review_scores, critic_review_names, main_trailer_video, secondary_trailer_video, game_image_1, game_image_2, game_image_3

    protected $fillable = [
        'title', 'description', 'price', 'cover_image', 'publisher', 'developer', 
        'release_date', 'owned', 'pge_rating', 'review_score', 'base_game_tag', 
        'tags', 'critic_review_scores', 'critic_review_names', 
        'main_trailer_video', 'secondary_trailer_video',
        'game_image_1', 'game_image_2', 'game_image_3'
    ];   
    
    protected $primaryKey = 'game_id';
    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image 
            ? asset('storage/' . $this->cover_image) 
            : asset('default-game-image.jpg');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_games', 'game_id', 'user_id')
                    ->withTimestamp('purchased_at')
                    ->withTimestamps();
    }

    /**
     * Get array of tags for the game
     * @return array
     */
    public function getTagsArrayAttribute()
    {
        return $this->tags ? explode(',', $this->tags) : [];
    }
    
    /**
     * Get array of critic review scores
     * @return array
     */
    public function getCriticScoresArrayAttribute()
    {
        return $this->critic_review_scores ? explode(',', $this->critic_review_scores) : [];
    }
    
    /**
     * Get array of critic review names
     * @return array
     */
    public function getCriticNamesArrayAttribute()
    {
        return $this->critic_review_names ? explode(',', $this->critic_review_names) : [];
    }
    
    /**
     * Get critic reviews as combined array with names and scores
     * @return array
     */
    public function getCriticReviewsAttribute()
    {
        $names = $this->getCriticNamesArrayAttribute();
        $scores = $this->getCriticScoresArrayAttribute();
        
        $reviews = [];
        for ($i = 0; $i < min(count($names), count($scores)); $i++) {
            $reviews[] = [
                'name' => $names[$i],
                'score' => $scores[$i]
            ];
        }
        
        return $reviews;
    }
    
    /**
     * Get array of game screenshots/images
     * @return array
     */
    public function getGameImagesAttribute()
    {
        $images = [];
        
        if ($this->game_image_1) {
            $images[] = asset('storage/' . $this->game_image_1);
        }
        
        if ($this->game_image_2) {
            $images[] = asset('storage/' . $this->game_image_2);
        }
        
        if ($this->game_image_3) {
            $images[] = asset('storage/' . $this->game_image_3);
        }
        
        return $images;
    }
    
    /**
     * Get the main trailer video URL
     * @return string|null
     */
    public function getMainTrailerUrlAttribute()
    {
        return $this->main_trailer_video ? asset('storage/' . $this->main_trailer_video) : null;
    }
    
    /**
     * Get the secondary trailer video URL
     * @return string|null
     */
    public function getSecondaryTrailerUrlAttribute()
    {
        return $this->secondary_trailer_video ? asset('storage/' . $this->secondary_trailer_video) : null;
    }
}
