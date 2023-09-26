<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\WishlistRequest;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\MailSubcribes;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Search;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Video;
use App\Models\Wishlist;
use App\Models\WishlistProduct;
use Artesaos\SEOTools\Facades\SEOMeta;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){


        SEOMeta::setTitle("WesterPark Studio | Amsterdam | ".__('site.equipment').' | '. __('site.studio'));
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());
        return view('frontend.index');
    }

    public function brand($brand){

        $show = Brand::whereHas('translations', function ($query) use ($brand) {
            $query->where('slug', $brand);
        })->first();
    /*    $dt = Carbon::parse($show->created_at);
        dd($dt->timestamp, Carbon::parse($dt->timestamp));
        $c = Carbon::parse($dt->timestamp);*/
        views($show)->cooldown(60)->collection('view')->record();

        $all = Product::whereHas('getCategory',  function ($query) use ($show) {
            $query->where('brand', $show->id);
        })->orderby('created_at','desc')->get();

        return view('frontend.rental.brand',compact('all', 'show'));
    }

    public function brands(){
        $all = Brand::withCount('getProduct')->get();
        return view('frontend.rental.brands',compact('all'));
    }

    public function rental(){

        SEOMeta::setTitle(__('site.equipment')." | WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        $brand = Brand::withCount('getProduct')->whereNotIn('id', [29])->inRandomOrder()->limit('8')->get();

        return view('frontend.rental.index', compact('brand'));
    }

    public function rentals($url){

        $show = ProductCategory::whereHas('translations', function ($query) use ($url) {
            $query->where('slug', $url);
        })->first();

        views($show)->cooldown(60)->collection('view')->record();

        $all = Product::whereHas('getCategory',  function ($query) use ($show) {
            $query->where('category_id', $show->id);
        })->orderby('rank','asc')->get();

        SEOMeta::setTitle($show->title ." | Apparatuur Verhuur | WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.rental.detail',compact('all','show'));
    }

    public function product($categoryurl,$producturl){

        $c= ProductCategory::whereHas('translations', function ($query) use ($categoryurl) {
            $query->where('slug', $categoryurl);
        })->first();

        $product = Product::with('getBrand')->whereHas('translations', function ($query) use ($producturl) {
            $query->where('slug', $producturl);
        })->first();

        views($product)->cooldown(60)->collection('view')->record();

        SEOMeta::setTitle($product->title. ' Verhuur'." | WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.rental.product', compact('product','c'));
    }

    public function addtocart($slug,$category){

        $p = Product::with('getBrand')->whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();

        views($p)->collection('addCart')->record();

        Cart::instance('shopping')->add(
            [
                'id' => $p->id,
                'name' => $p->title,
                'price' => $p->price,
                'weight' => 0,
                'qty' => 1,
                'options' => [
                    'image' => (!$p->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg' : $p->getFirstMediaUrl('page', 'small'),
                    'lang' => config('app.locale'),
                    'url' => $slug,
                    'brand' => $p->getBrand->title,
                    'brandImage' => $p->getBrand->getFirstMediaUrl('page','small'),
                    'category' => $category,
                ]
            ]);
        alert()->html('Added','<b>'.$p->title.'</b> Product have added to your cart.')->success()->autoClose(2000);
        return redirect()->back();
    }

    public function deletecart($rowId){
        Cart::instance('shopping')->remove($rowId);
        alert()->html('Delete','Product removed from cart')->info()->autoClose(2000);
        return redirect()->back();
    }

    public function cart(){

        SEOMeta::setTitle("Cart | WesterPark Studio | Amsterdam | ".__('site.equipment').' | '. __('site.studio'));
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.rental.cart');
    }

    public function checkout(Request $request){

        SEOMeta::setTitle("Checkout | WesterPark Studio | Amsterdam | ".__('site.equipment').' | '. __('site.studio'));
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());
        return view('frontend.rental.checkout', compact('request'));
    }

    public function studio(){

        SEOMeta::setTitle(__('site.studio')." | WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        $all = Service::all();

        $show = ServiceCategory::where('id', 3)->firstOrFail();

        return view('frontend.studio.index', compact('all','show'));
    }

    public function studio_detail($url){

        $show = Service::whereHas('translations', function ($query) use ($url) {
            $query->where('slug', $url);
        })->first();

        views($show)->cooldown(60)->collection('view')->record();

        SEOMeta::setTitle("WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.studio.studio', compact('show'));
    }

    public function contactus(){

        SEOMeta::setTitle("Contact Us | WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.pages.contact-us');
    }

    public function contact(ContactRequest $request){
        $New = Contact::create($request->except('_token'));

        Mail::send("frontend.mail.contact",compact('New'),function ($message) use($New) {
            $message->to('info@westerparkstudio.nl')->subject($New->name.' - '.$New->email.' WPS Contact Form');
        });
        //info@westerparkstudio.nl
        //olcayy@gmail.com
        alert()->success('Successfully Sent','Your request has reached us. We will get back to you as soon as possible.')->autoClose(2000);


        return redirect()->route('contactus');
    }

    public function gallery(){

        SEOMeta::setTitle("Gallery | WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.gallery.index');
    }

    public function video(){

        SEOMeta::setTitle("Video Gallery | Amsterdam WesterPark Studio | ".__('site.equipment').' | '. __('site.studio'));
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());
        $all = Video::all();
        return view('frontend.gallery.video',  compact('all'));
    }

    public function foto(){

        SEOMeta::setTitle("Foto Gallery | Amsterdam WesterPark Studio | ".__('site.equipment').' | '. __('site.studio'));
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());
        $all = GalleryCategory::with('getGallery')->withCount('getGallery')->get();
        return view('frontend.gallery.fotos', compact('all'));
    }

    public function foto_gallery(Request $request, $url){

        $show = GalleryCategory::whereHas('translations', function ($query) use ($url) {
            $query->where('slug', $url);
        })->first();

        views($show)->cooldown(60)->collection('view')->record();

        $all = Gallery::where('category', $show->id)->get();
        SEOMeta::setTitle($show->title." | WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.gallery.fotochild', compact('show', 'all'));
    }

    public function foto_detail($slug, $url){

        $show = GalleryCategory::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();

        $all = Gallery::whereHas('translations', function ($query) use ($url) {
            $query->where('slug', $url);
        })->first();

        views($all)->cooldown(60)->collection('view')->record();

        SEOMeta::setTitle($show->title." | ". $all->title ." | WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.gallery.foto', compact('show', 'all'));
    }

    public function project(){

        SEOMeta::setTitle("WesterPark Studio | Amsterdam WesterPark Studio | ".__('site.equipment').' | '. __('site.studio'));
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        return view('frontend.gallery.project');
    }

    public function faq(){

        SEOMeta::setTitle("F.A.Q | Amsterdam WesterPark Studio | ".__('site.equipment').' | '. __('site.studio'));
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        $all = Faq::all();

        return view('frontend.pages.faq',compact('all'));
    }

    public function kinefinity(){

        SEOMeta::setTitle("Kinefinity Cinema Camera | WesterPark Studio | Amsterdam");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        $all = Service::all();

        return view('frontend.studio.kinefinity', compact('all'));
    }

    public function services(){

        SEOMeta::setTitle("Services | Amsterdam WesterPark Studio | ".__('site.equipment').' | '. __('site.studio'));
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        $all = Service::all();

        return view('frontend.studio.service',compact('all'));
    }

    public function mailsubscribe(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:mail_subcribes',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()]);
        }

        $data = new MailSubcribes();
        $data->email = $request->email;
        $data->lang = config('app.locale');
        $data->save();

        alert()->success('Successfully Sent','Your request has reached us. We will get back to you as soon as possible.')->autoClose(2000);
        return redirect()->back();

    }

    public function search(Request $request){

        $q = $request->q;

        if (strlen($q) >= 2 && ozelKarakterFiltrele($q) == false){
            Search::create(['key' => $q, 'language' => config('app.locale')]);
        }else{
            return redirect()->back();
        }

        SEOMeta::setTitle("  ".$q. " | Amsterdam WesterPark Studio | ");
        SEOMeta::setDescription("Wester Park Studio");
        SEOMeta::setCanonical(url()->full());

        $all = Product::with('getCategory')->orderby('created_at','desc')->whereHas('translations', function ($query) use ($q) {
            $query->where('title', 'like', '%'.$q.'%')
                ->orWhere('slug', 'like', '%'.$q.'%')
                ->orWhere('seo1', 'like', '%'.$q.'%');
        })->paginate(24);

        return view('frontend.rental.search', compact('all', 'q'));
    }

    public function wishlistsave(WishlistRequest $request){

        session()->forget('offer_no');

        DB::transaction(function () use ($request) {

            foreach (Cart::instance('shopping')->content() as $c){
                $subtotal[] = money(kiralamaUcretiHesapla($c->price, $request->day) * $c->qty);
            }

            $st = money(array_sum($subtotal));
            $vt = money(array_sum($subtotal) * 0.21);
            $total = money($vt + $st);

            $New = new Wishlist;

            $New->name = $request->name;
            $New->company = $request->company;
            $New->phone = $request->phone;
            $New->email = $request->email;
            $New->message = $request->message;
            $New->address = $request->address;
            $New->delivery = 'Westerpark Studio';
            $New->locale = config('app.locale');
            $New->day = $request->day;
            $New->subtotal = $st;
            $New->vat = $vt;
            $New->totalprice = $total;
            $New->save();

            foreach (Cart::instance('shopping')->content() as $item) {
                $wl = new WishlistProduct;
                $wl->wishlist_id = $New->id;
                $wl->product_id = $item->id;
                $wl->product_name = $item->name;
                $wl->price = $item->price;
                $wl->quantity = $item->qty;
                $wl->save();
            }

            Cart::instance('shopping')->destroy();

            $Product = Product::with('getBrand')->whereHas('wishlistProduct', function($query) use ($New)  {
                   return $query->where('wishlist_id', $New->id);
            })->get();


/*
          Mail::send("frontend.mail.offer",compact('New', 'Product'),function ($message) use($New) {
                $message->to('info@westerparkstudio.nl')->subject($New->name.' - '.$New->email.' Offer Form');
          });*/

          session()->put('offer_no', $New->id);

        });
        return redirect()->route('success');
//      alert()->success('Successfully Sent','Product have added to your wishlist.')->autoClose(4000);
    }

    public function success(Request $request){

        $Whishlist= Wishlist::where('id', $request->session()->get('offer_no'))->first();

        //dd($Whishlist);

       $Product = Product::with('getBrand')->whereHas('wishlistProduct', function($query) use ($request)  {
           return $query->where('wishlist_id', $request->session()->get('offer_no'));
       })->get();

        return view('frontend.rental.success', compact('Product', 'Whishlist'));
    }
 }
