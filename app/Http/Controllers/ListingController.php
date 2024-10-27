<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePropertyRequest;
use App\Models\Listing;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ListingController extends Controller
{

    public function index(Request $request)
    {
        $filters = $request->only(['priceFrom','priceTo','beds','baths','areaFrom','areaTo','street','city']);

        $listings = Listing::filter($filters)->notsold()->mostrecent()->paginate(6)
        ->withQueryString();
        // dd($listings);

    

        return Inertia('Listing/Index',[
                    'filters' => $filters,
                    'listings' => $listings
        ]);
        


    }

   
    public function show(Listing $listing)
    {
        $offer = null;
        if(Auth::user()) {
            // $offer = $listing->offers()->where('user_id',Auth::user()->id)->first();
            $offer = $listing->offers()->byme()->first();
        }

        // dd($offer);
        
        return Inertia('Listing/Show',[
            'listing' => $listing,
            'images' => $listing->images,
            'videos' => $listing->videos,
            'offer' => $offer,
            'ratings' => $listing->ratings,
            'is_commented' => $listing->ratings()->byme()->first()
        ]);
    }

   

   
}
