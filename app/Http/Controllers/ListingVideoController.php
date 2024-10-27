<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingVideo;
use Illuminate\Http\Request;
use Storage;

class ListingVideoController extends Controller
{
    
    public function destroy(Listing $listing,ListingVideo $video)
    {
        // dd($video->video_url);
        if (Storage::disk('public')->exists($video->video_url)) {
            Storage::disk('public')->delete($video->video_url);
        } 
        $video->delete();
        return redirect()->route('realtor.listings.image.create', $listing)->with('success', 'Removed video successfully!');
    }
}
