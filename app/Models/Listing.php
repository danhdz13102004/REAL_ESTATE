<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['beds','baths','area','city','code','street','street_nr','price','user_id'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->hasMany(ListingImage::class);
    }

    public function scopeMostRecent(Builder $query) {
        return $query->orderByDesc('created_at');
    }

    public function scopeOrderPrice(Builder $query) {
        return $query->orderBy('price');
    }


    public function scopeFilter(Builder $query,array $filters) {
        return $query->when(
            $filters['priceFrom'] ?? false,
            fn ($query, $value) => $query->where('price', '>=', $value)
        )->when(
            $filters['priceTo'] ?? false,
            fn ($query, $value) => $query->where('price', '<=', $value)
        )->when(
            $filters['beds'] ?? false,
            fn ($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['baths'] ?? false,
            fn ($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['areaFrom'] ?? false,
            fn ($query, $value) => $query->where('area', '>=', $value)
        )->when(
            $filters['areaTo'] ?? false,
            fn ($query, $value) => $query->where('area', '<=', $value)
        )->when(
            $filters['street'] ?? false,
            fn ($query, $value) => $query->where('street','LIKE', '%' . $value . '%')
        )->when(
            $filters['city'] ?? false,
            fn ($query, $value) => $query->where('city','LIKE', '%' . $value . '%')
        )->when(
            $filters['deleted'] ?? false,
            fn ($query, $value) => $query->withTrashed()
        )->when(
            $filters['by'] ?? false,
            fn ($query, $value) => $query->orderBy($value,$filters['order'] ?? 'asc')
        );
    }

    public function scopeNotSold(Builder $query) {
        // return $query->doesntHave('offers')
        //               ->orWhereHas('offers',function ($query){
        //                 $query->whereNull('accepted_at')->whereNull('rejected_at');
        //               });
        return $query->whereNull('sold_at');
    }

    public function offers() {
        return $this->hasMany(Offer::class);
    }

    public function videos() {
        return $this->hasMany(ListingVideo::class);
    }

    public function ratings() {
        return $this->hasMany(ListingRating::class);
    }
}  
