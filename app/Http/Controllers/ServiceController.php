<?php

namespace App\Http\Controllers;

use App\Models\PageCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function index()
    {
        $All = Service::with('getCategory')->orderBy('rank')->get();
        $Kategori = ServiceCategory::all();

        return view('backend.service.index', compact('All', 'Kategori'));
    }

    public function create()
    {
        $Kategori = ServiceCategory::all();
        return view('backend.service.create',compact('Kategori'));
    }

    public function store(Request $request)
    {
        $New = Service::create($request->except('_token', 'image', 'gallery'));


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
        return redirect()->route('service.index');
    }

    public function show($id)
    {
        $Show = Service::findOrFail($id);
        return view('frontend.service.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = Service::findOrFail($id);
        $Kategori = ServiceCategory::all();
        return view('backend.service.edit', compact('Edit', 'Kategori'));
    }

    public function update(Request $request, Service $Update)
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
        return redirect()->route('service.index');

    }

    public function destroy($id)
    {
        $Delete = Service::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('service.index');
    }

    public function getTrash(){
        $Trash = Service::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return view('backend.service.trash', compact('Trash'));
    }

    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Service::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Service::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }

    public function deleteGaleriDelete($id){

        $Delete = Service::find($id);
        $Delete->media()->where('id', \request('image_id'))->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('service.edit', $id);

    }
}
