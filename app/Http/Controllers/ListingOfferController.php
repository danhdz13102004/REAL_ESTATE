<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ListingOfferController extends Controller
{

    public function index(Request $request,Listing $listing) {
        Gate::authorize('offers',$listing);
        $offers = Offer::with(['user:id,name'])->where('listing_id',$listing->id)->get();
        // dd($offers);
        
        return Inertia('Realtor/ShowOffers',[
            'listing' => $listing,
            'offers' => $offers
        ]);
    }

    public function store(Request $request,Listing $listing) {
        Gate::authorize('addoffer',$listing);
        
        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer|min:1|max:20000000'
        ]);
    
        if ($validator->fails()) {
            return back()->with('validate',$validator->messages())->withInput();
        }

        $offer = Offer::create([
            'amount' => $request->input('amount'),
            'user_id' => $request->user()->id,
            'listing_id' => $listing->id 
        ]);

        $listing->user->notify(new OfferMade($offer));
        
        return back()->with('success','Make an offer successfully!');
    }  

    public function update(Request $request,Listing $listing,Offer $offer) {
        $offer->update([
            'accepted_at' => now()
        ]);

        $listing->sold_at = now();
        $listing->save();


        $listing->offers()->except($offer)->update([
            'rejected_at' => now()
        ]);

        return redirect()->route('listings.offer.index',$listing->id)->with('success','Accept succesfully!');
    }
}
