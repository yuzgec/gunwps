<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $All = Brand::orderBy('rank')->get();
        return view('backend.brand.index', compact('All'));
    }

    public function create()
    {
        return view('backend.brand.create');
    }

    public function store(Request $request)
    {
        $New = Brand::create($request->except('_token', 'image', 'gallery'));

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
        return redirect()->route('brand.index');
    }

    public function show($id)
    {
        $Show = Brand::findOrFail($id);
        return view('frontend.brand.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = Brand::findOrFail($id);
        return view('backend.brand.edit', compact('Edit'));
    }

    public function update(Request $request, Brand $Update)
    {
        $Update->update($request->except('_token', '_method','image', 'gallery','removeImage'));

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
        return redirect()->route('brand.index');

    }

    public function destroy($id)
    {
        $Delete = Brand::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('brand.index');
    }


    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Brand::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Brand::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }

    public function deleteGaleriDelete($id){

        $Delete = Brand::find($id);
        $Delete->media()->where('id', \request('image_id'))->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('brand.edit', $id);

    }
}
