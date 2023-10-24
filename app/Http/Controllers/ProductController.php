<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ProdoctCategoryPivot;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\RelatedIncludeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $pc = (request('product_categori')) ? (request('product_categori')) : 11;

        $All = Product::whereHas('getCategory', function ($query) use($pc) {
            return $query->where('category_id', $pc);
        })->orderBy('rank', 'asc')->get();

        if (request()->filled('q')){
            $q = \request('q');
            $All = Product::with(['getCategory'])->whereHas('translations', function ($query) use ($q) {
                $query->where('title', 'like', '%'.$q.'%')
                    ->orWhere('slug', 'like', '%'.$q.'%')
                    ->orWhere('seo1', 'like', '%'.$q.'%');
            })->paginate(24);
        }
        $Kategori = ProductCategory::orderBy('rank', 'asc')->get();

        return view('backend.product.index', compact('All', 'Kategori'));
    }

    public function create()
    {
        $Kategori = ProductCategory::orderBy('rank', 'asc')->get();
        $Brand = Brand::all();
        $Product = Product::all();
        return view('backend.product.create',compact('Kategori', 'Brand', 'Product'));
    }

    public function store(Request $request)
    {

        DB::transaction(function () use($request){
            $New = Product::create($request->except('_token', 'image', 'gallery', 'category', 'web_nl', 'mobil_nl', 'web_en', 'mobil_en'));

            if ($request->hasfile('image')) {
                $New->addMedia($request->image)->toMediaCollection('page');
            }

            if ($request->hasfile('gallery')) {
                foreach ($request->gallery as $item) {
                    $New->addMedia($item)->toMediaCollection('gallery');
                }
            }

            if ($request->category) {
                foreach ($request->category as $c) {
                    $Category = new ProdoctCategoryPivot;
                    $Category->product_id = $New->id;
                    $Category->category_id = $c;
                    $Category->save();
                }
            }
        });

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('product.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $Edit = Product::with('getCategory')->where('id',$id)->first();
        $Kategori = ProductCategory::get()->toFlatTree();
        $Brand = Brand::all();
        $Product = Product::all();

        return view('backend.product.edit', compact('Edit', 'Kategori','Brand', 'Product'));
    }

    public function update(Request $request, Product $Update)
    {

        DB::transaction(function () use($request, $Update) {

            $Update->update($request->except('_token', 'image', 'gallery', 'category', 'related', 'included'));

            if ($request->removeImage == "1") {
                $Update->media()->where('collection_name', 'page')->delete();
            }

            if ($request->hasFile('image')) {
                $Update->media()->where('collection_name', 'page')->delete();
                $Update->addMedia($request->image)->toMediaCollection('page');
            }


            if ($request->hasfile('gallery')) {
                foreach ($request->gallery as $item) {
                    $Update->addMedia($item)->toMediaCollection('gallery');
                }
            }

            $Update->save();

            //dd($request->related);

            if ($request->related) {
                foreach ($request->related as $c) {
                    $Delete = RelatedIncludeProduct::where(['product_id' => $Update->id, 'related_id' => $c]);
                    $Delete->delete();
                }
                foreach ($request->related as $c) {
                    RelatedIncludeProduct::updateOrCreate(['product_id' => $Update->id, 'name' => 'related', 'related_id' => $c]);
                }
            }

            if ($request->included) {
                foreach ($request->included as $c) {
                    $Delete = RelatedIncludeProduct::where(['product_id' => $Update->id, 'related_id' => $c]);
                    $Delete->delete();
                }
                foreach ($request->included as $c) {
                    RelatedIncludeProduct::updateOrCreate(['product_id' => $Update->id, 'name' => 'included', 'related_id' => $c]);
                }
            }

            if ($request->category) {
                foreach ($request->category as $c) {
                    ProdoctCategoryPivot::updateOrCreate(['product_id' => $Update->id, 'category_id' => $c]);
                }
            }
        });

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('product.index');
    }


    public function destroy($id)
    {
        $Delete = Product::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('product.index');
    }

    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Product::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Product::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }

    public function deleteGaleriDelete($id){

        $Delete = Product::find($id);
        $Delete->media()->where('id', \request('image_id'))->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('product.edit', $id);
    }
}
