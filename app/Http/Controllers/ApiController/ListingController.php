<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request, $page) {
        $listings = Listing::orderByDesc('created_at')->paginate(9, ['*'], 'page', $page);
        return $listings;
    }
}
