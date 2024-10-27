<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use App\Models\ListingVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ListingImageController extends Controller
{
    public function create(Request $request, Listing $listing)
    {

        // dd($listing->images);
        return Inertia(
            'Realtor/ListingImage/Create',
            [
                'listing' => $listing,
                'images' => $listing->images,
                'videos' => $listing->videos
            ]
        );
    }

    public function store(Request $request, Listing $listing)
    {
        $totalSize = 0;
        $maxsize = 30000 * 1000;
        foreach ($request->file('images') as $file) {
            $totalSize += $file->getSize(); // Get size in bytes
        }
        if($totalSize > $maxsize) {
            return redirect()->back()->with('validate.error',"Cant upload file size more than 30MB");
        }

        if ($request->hasFile('images')) {



            foreach ($request->file('images') as $file) {
                $mimeType = $file->getMimeType();
                
                if (str_starts_with($mimeType, 'image/')) {
                    $path =  $file->store('images', 'public');
                    ListingImage::create([
                        'image_url' => $path,
                        'listing_id' => $listing->id
                    ]);
                }

                if (str_starts_with($mimeType, 'video/')) {
                    $path =  $file->store('video', 'public');
                    ListingVideo::create([
                        'video_url' => $path,
                        'listing_id' => $listing->id
                    ]);
                }
            }
        }
        return redirect()->route('realtor.listings.image.create', $listing)->with('success', 'Upload successfully!');
    }

    public function destroy(Request $request, Listing $listing, ListingImage $image)
    {
        
        Storage::disk('public')->delete($image->image_url);
        $image->delete();
        return redirect()->route('realtor.listings.image.create', $listing)->with('success', 'Removed images successfully!');
    }
}
