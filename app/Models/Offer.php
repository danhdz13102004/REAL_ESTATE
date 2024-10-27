<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Offer extends Model
{
    use HasFactory;

    const STATUS_COMPLETED = 1;
    const STATUS_FAILED = 2;
    const STATUS_PROCESSING = 3;
    
    // protected $with = ['user:id,name'];
    protected $fillable = ['listing_id','user_id','amount','accepted_at','rejected_at','payment_status'] ;

    public function listing() {
        return $this->BelongsTo(Listing::class);
    }

    public function user() {
        return $this->BelongsTo(User::class);
    }

    public function scopeByMe(Builder $query) {
        return $query->where('user_id', Auth::user()?->id);
    }

    public function scopeExcept(Builder $query,Offer $offer) {
        return $query->where('id','!=',$offer->id);
    }

}
