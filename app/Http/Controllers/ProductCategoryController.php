<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    public function index()
    {
        $All = ProductCategory::orderBy('rank', 'asc')->get();
        return view('backend.productcategory.index', compact('All'));
    }

    public function create()
    {
        $Kategori = ProductCategory::orderBy('rank', 'desc')->get();
        return view('backend.productcategory.create',  compact('Kategori'));
    }

    public function store(Request $request)
    {
        $New = ProductCategory::create($request->except('_token', 'image'));

        if($request->image){
            $New->addMedia($request->image)->toMediaCollection();
        }

        if ($request->parent_id){
            $node = ProductCategory::find($request->parent_id);
            $node->appendNode($New);
        }

        $New->save();

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('productcategory.index');

    }


    public function show($id)
    {
        $Show = ProductCategory::findOrFail($id);
        return view('frontend.pagecategory.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = ProductCategory::findOrFail($id);
        $Kategori = ProductCategory::orderBy('rank', 'desc')->get();

        return view('backend.productcategory.edit', compact('Edit', 'Kategori'));
    }

    public function update(Request $request, ProductCategory $Update)
    {

        $Update->update($request->except('_token', '_method', 'image', 'gallery', 'cover'));

        if ($request->parent_id){
            $node = ProductCategory::find($request);
            $node->appendNode($Update);
        }

        if ($request->removeImage == "1") {
            $Update->media()->where('collection_name', 'page')->delete();
        }

        if ($request->hasFile('image')) {
            $Update->media()->where('collection_name', 'page')->delete();
            $Update->addMedia($request->image)->toMediaCollection('page');
        }

        if ($request->hasFile('cover')) {
            $Update->media()->where('collection_name', 'cover')->delete();
            $Update->addMedia($request->cover)->toMediaCollection('cover');
        }

        if ($request->hasfile('gallery')) {
            foreach ($request->gallery as $item) {
                $Update->addMedia($item)->toMediaCollection('gallery');
            }
        }

        $Update->save();

        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('productcategory.index');

    }

    public function destroy($id)
    {
        $Delete = ProductCategory::find($id);
        if($Delete->getCategoryCount() > 0){
            alert()->error('Silinemez','Kategoriye ait sayfa bulunmaktadır.');
            return redirect()->back();
        }
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('productcategory.index');
    }

    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            ProductCategory::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function postUpload(Request $request)
    {

        if($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = seo($filename).'_'.time().'.'.$extension;
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore);
            $msg = 'Resim Yüklendi';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
