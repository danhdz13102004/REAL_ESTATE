<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListingRating extends Model
{
    use HasFactory;

    protected $with = ['user:id,name,avatar'];
    protected $fillable = ['user_id','listing_id','comment','rate'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function listing() {
        
        return $this->belongsTo(Listing::class);
    }
    public function scopeByMe(Builder $query) {
        return $query->where('user_id', Auth::user()?->id);
    }
}
