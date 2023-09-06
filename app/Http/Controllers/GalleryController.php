<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $All = Gallery::with('getCategory')->orderBy('rank')->get();
        $Kategori = GalleryCategory::get()->toFlatTree();

        return view('backend.gallery.index', compact('All', 'Kategori'));
    }

    public function create()
    {
        $Kategori = GalleryCategory::get()->toFlatTree();
        return view('backend.gallery.create',compact('Kategori'));
    }

    public function store(Request $request)
    {
        $New = Gallery::create($request->except('_token', 'image', 'gallery'));


        if($request->hasfile('image')){
            $New->addMedia($request->image)->toMediaCollection('page');
        }
        if($request->hasfile('gallery')) {
            foreach ($request->gallery as $item){
                $New->addMedia($item)->toMediaCollection('gallery');
            }
        }

        $New->save();

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('gallery.index');
    }

    public function show($id)
    {
        $Show = Gallery::findOrFail($id);
        return view('frontend.gallery.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = Gallery::findOrFail($id);
        $Kategori = GalleryCategory::all();
        return view('backend.gallery.edit', compact('Edit', 'Kategori'));
    }

    public function update(Request $request, Gallery $Update)
    {
        $Update->update($request->except('_token', '_method'));

        if($request->removeImage == "1"){
            $Update->media()->where('collection_name', 'page')->delete();
        }

        if ($request->hasFile('image')) {
            $Update->media()->where('collection_name', 'page')->delete();
            $Update->addMedia($request->image)->toMediaCollection('page');
        }

        if($request->hasfile('gallery')) {
            foreach ($request->gallery as $item){
                $Update->addMedia($item)->toMediaCollection('gallery');
            }
        }

        $Update->save();

        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('gallery.index');

    }

    public function destroy($id)
    {
        $Delete = Gallery::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('gallery.index');
    }

    public function getTrash(){
        $Trash = Gallery::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('backend.service.trash', compact('Trash'));
    }

    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Gallery::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Gallery::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }

    public function deleteGaleriDelete($id){

        $Delete = Gallery::find($id);
        $Delete->media()->where('id', \request('image_id'))->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('gallery.edit', $id);

    }
}
