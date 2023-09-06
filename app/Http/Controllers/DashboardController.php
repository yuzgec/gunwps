<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Search;
use App\Models\Wishlist;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Support\Period;

class DashboardController extends Controller
{
    public function index(){
        $Search = Search::select('key', 'language')->paginate(10);

        $wishlist = Wishlist::with(['getProduct', 'getOffer'])->withCount('getProduct')->limit(10)->get();

        $contact = Contact::limit(10)->get();

        return view('backend.index', compact('Search', 'wishlist', 'contact'));
    }
}


