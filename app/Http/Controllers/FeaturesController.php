<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeaturesRequest;
use App\Models\Features;
use App\Models\Service;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index()
    {
        $All = Features::all();
        $Kategori = Service::pluck('title', 'id');
        return view('backend.features.index', compact('All', 'Kategori'));
    }

    public function create()
    {
        $Kategori = Service::pluck('title', 'id');
        return view('backend.features.create',  compact('Kategori'));
    }


    public function store(FeaturesRequest $request)
    {
        $New = new Features;
        $New->title = $request->title;
        $New->category = $request->category;
        $New->desc = $request->desc;

        if($request->image){
            $New->addMedia($request->image)->toMediaCollection();
        }

        $New->save();
        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('features.index');

    }


    public function show($id)
    {
        $Show = Features::findOrFail($id);
        return view('frontend.features.index', compact('Show'));

    }

    public function edit($id)
    {
        $Edit = Features::findOrFail($id);
        $Kategori = Service::pluck('title', 'id');
        return view('backend.features.edit', compact('Edit', 'Kategori'));
    }

    public function update(FeaturesRequest $request, $id)
    {

        $Update = Features::findOrFail($id);

        $Update->title = $request->title;
        $Update->category = $request->category;
        $Update->desc = $request->desc;

        $Update->save();

        if ($request->hasFile('image')) {
            $Update->media()->delete();
            $Update->addMedia($request->image)->toMediaCollection();
        }
        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('features.index');

    }

    public function destroy($id)
    {
        $Delete = Features::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('features.index');
    }


    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Features::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Features::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }


}

