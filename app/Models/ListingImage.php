<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_url','listing_id'];
    protected $appends = ['src'];

    public function listing() {
        $this->belongsTo(Listing::class);
    }


    public function getSrcAttribute() {
        return asset("storage/" .$this->image_url);
    }
}
