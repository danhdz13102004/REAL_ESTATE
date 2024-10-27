<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class RealtorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!$request->user()->email_verified_at) {
            return Inertia(
                'Realtor/NotVerified'
            );
        }

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by','order'])
        ];
        $listings = Auth::user()->listings()->filter($filters)->withCount(['images','offers','videos'])->paginate(6)->withQueryString();

        return Inertia(
            'Realtor/Index',
            [
                'listings' =>$listings,
                'filters' => $filters
            ]
        );
    }

    public function create()
    {
        return inertia('Realtor/Create');
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'beds' => 'required|integer|min:1',
            'baths' => 'required|integer|min:1',
            'area' => 'required|integer|min:10',
            'city' => 'required|string',
            'street' => 'required|string',
            'code' => 'required|string|min:5',
            'street_nr' => 'required|integer',
            'price' => 'required|numeric|min:0'
        ]);
        if($validator->fails()) {
            return redirect()->back()->with('validate',$validator->errors()->messages());
            // return back()->withErrors($validator)->withInput();
        }
        $listing = Listing::make($request->all());
        $listing->user_id = Auth::user()->id;
        $listing->save();
        // dd($listing);    
        

        return redirect()->route('realtor.listings.index')->with('success', "Ngon roi bro!!");
    }

  
    public function edit(Listing $listing)
    {
        // Gate::authorize('update',$listing);
       if(Auth::user()->cannot('update',$listing)) {
            abort(403);
       }

        return inertia('Realtor/Update',[
            'listing' => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Listing $listing)
    {
        Gate::authorize('update',$listing);
        $validator = Validator::make($request->all(), [
            'beds' => 'required|integer|min:1',
            'baths' => 'required|integer|min:1',
            'area' => 'required|integer|min:10',
            'city' => 'required|string',
            'street' => 'required|string',
            'code' => 'required|string|min:5',
            'street_nr' => 'required',
            'price' => 'required|numeric|min:0',
        ]);
        if($validator->fails()) {
            return redirect()->back()->with('validate',$validator->errors()->messages());
            // return back()->withErrors($validator)->withInput();
        }

        $listing->update(request()->all());

        return redirect()->route('listings.show',$listing->id)->with('success',"Update successfully!");
    }

  
    
    public function destroy(Request $request,Listing $listing)
    {
        Gate::authorize('delete',$listing);
        $listing->delete();
        return redirect()->route('realtor.listings.index')->with('success',"Delete successfully!");
    }

    public function restore(Request $request,Listing $listing) {
        Gate::authorize('restore',$listing);
        $listing->restore();
        return redirect()->route('realtor.listings.index', ['deleted' => true])->with('success',"Restore successfully!");
    }

    public function verify(Request $request,$id) {
        // dd($id);
        $user = User::find($id);
        if($user) {
            $user->email_verified_at = now();
            $user->save();
            if(Auth::user()) {
                return redirect()->route('realtor.listings.index')->with('success',"Verified email sucessfully");
            }
            else { 
                return redirect()->route('login')->with('success',"Verified email sucessfully");
            }
        }
    }
}
