<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Models\Page;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $All = Video::all();
        return view('backend.video.index', compact('All'));
    }

    public function create()
    {
        return view('backend.video.create');
    }


    public function store(Request $request)
    {

        $New = Video::create($request->except('_token', 'image'));

        if($request->hasfile('image')){
            $New->addMedia($request->image)->toMediaCollection('page');
        }

        $New->save();

        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('video.index');

    }


    public function show($id)
    {


    }

    public function edit($id)
    {
        $Edit = Video::findOrFail($id);
        return view('backend.video.edit', compact('Edit'));
    }

    public function update(Request $request, Video $Update)
    {

        $Update->update($request->except('_token', '_method', 'image'));

        if ($request->removeImage == "1") {
            $Update->media()->where('collection_name', 'page')->delete();
        }

        if ($request->hasFile('image')) {
            $Update->media()->where('collection_name', 'page')->delete();
            $Update->addMedia($request->image)->toMediaCollection('page');
        }

        $Update->save();
        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('video.index');

    }

    public function destroy($id)
    {
        $Delete = Video::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('video.index');
    }

    public function getOrder(Request $request){
        foreach($request->get('page') as  $key => $rank ){
            Video::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Video::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }

}
