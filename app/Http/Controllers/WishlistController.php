<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistOffer;
use App\Models\WishlistOfferProduct;
use App\Models\WishlistProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function index(){
        $wishlist = Wishlist::with(['getProduct', 'getOffer'])->withCount('getProduct')->get();
        return view('backend.wishlist.index',compact('wishlist'));
    }

    public function list($id){
        $wishlist = Wishlist::with(['getProduct', 'getOffer','getOfferProduct'])->where('id', $id)->withCount('getProduct')->first();


        //dd($wishlist);
        $productlist = WishlistProduct::where('wishlist_id', $id)->get();
        $product = Product::all();

        $wishlistoffer = WishlistOffer::where('wishlist_id', $wishlist->id)->get();

        $activeproduct = [];
        $changeproduct = [];

        foreach($wishlist->getOfferProduct as $item){
            $activeproduct[] = $item->product_id;
            $changeproduct[] = $item->product_changed_id;
        }


        //dd($activeproduct, $changeproduct);

        return view('backend.wishlist.list',compact('wishlist', 'productlist','product','wishlistoffer','activeproduct','changeproduct'));
    }

    public function send() {

    }

    public function print(Request $request, Wishlist $w){

        //dd($w->subtotal);
        DB::transaction(function () use($request,$w) {

            $indirimTutari = hesaplaIndirimTutari($w->subtotal, $request->discount_rate, $request->discount_type);

            $extra= null;
            if ($request->extraproduct){
                $extra = implode(',', $request->extraproduct);
            }

            $offer = new WishlistOffer;
            $offer->user_id = (auth()->user()->id) ? auth()->user()->id : time();
            $offer->wishlist_id = $request->wishlist_id;
            $offer->offermessage = $request->offermessage;
            $offer->discount_type = $request->discount_type;
            $offer->discount_rate = $request->discount_rate;
            $offer->discount_amount = $indirimTutari;
            $offer->extraproduct = $extra;
            $offer->totalprice = $w->totalprice;
            $offer->vat = $w->vat;
            $offer->subtotal =  $w->subtotal;
            $offer->save();

            $count = count($request->product_id) - 1;

            for ($i= 0; $i <= $count;$i++){
                $New = new WishlistOfferProduct;
                $New->product_id = $request->product_id[$i];
                $New->product_changed_id = $request->product_changed_id[$i];
                $New->wishlist_offer_id =  $offer->id;
                $New->wishlist_id =  $w->id;
                $New ->save();
            }

        });

        alert()->success('deneme', 'deneme');

        return redirect()->route('wishlist.list', $w->id);
    }
}
