<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingVideo extends Model
{
    use HasFactory;

    protected $fillable = ['listing_id','video_url'];
    protected $appends = ['src'];

    public function listing() {
        return $this->belongsTo(Listing::class);
    }

    public function getSrcAttribute() {
        return asset("storage/" .$this->video_url);
    }
}
