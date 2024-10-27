<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingRating;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListingRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Listing $listing)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|min:5|max:500',
            'rate' => 'required|integer|min:1|max:5' 
        ]);
        if($validator->fails()) {
            return redirect()->back()->with('validate',$validator->errors()->messages());
        }

        $rating =  ListingRating::create([
            'user_id' => Auth::user()->id,
            'listing_id' => $listing->id,
            'comment' => $request->input('comment'),
            'rate' => $request->input('rate')
        ]);
        // dd($rating);

        return redirect()->route('listings.show',$listing->id)->with('success','Post comment sucessfully!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(ListingRating $listingRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListingRating $listingRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ListingRating $listingRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListingRating $listingRating)
    {
        //
    }
}
