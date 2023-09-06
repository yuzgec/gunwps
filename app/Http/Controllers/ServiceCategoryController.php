<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{

    public function index()
    {
        $All = ServiceCategory::get()->toFlatTree();
        return view('backend.servicecategory.index', compact('All'));
    }

    public function create()
    {
        $Kategori = ServiceCategory::all();
        return view('backend.servicecategory.create', compact('Kategori'));
    }

    public function store(Request $request)
    {
        $New = ServiceCategory::create($request->except('_token', 'image', 'gallery'));

        if ($request->image) {
            $New->addMedia($request->image)->toMediaCollection();
        }

        if ($request->parent_id) {
            $node = ServiceCategory::find($request->parent_id);
            $node->appendNode($New);
        }

        toast(SWEETALERT_MESSAGE_CREATE, 'success');
        return redirect()->route('servicecategory.index');

    }

    public function show($id)
    {
        $Show = ServiceCategory::findOrFail($id);
        return view('frontend.servicecategory.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = ServiceCategory::findOrFail($id);
        $Kategori = ServiceCategory::all();

        return view('backend.servicecategory.edit', compact('Edit', 'Kategori'));
    }

    public function update(Request $request, ServiceCategory $Update)
    {
        //dd($request->all());

        $Update->update($request->except('_token', '_method', 'image', 'gallery', 'cover'));


        if ($request->hasFile('image')) {
            $Update->media()->delete();
            $Update->addMedia($request->image)->toMediaCollection();
        }

        if ($request->parent){
            $node = ServiceCategory::find($request);
            $node->appendNode($Update);
        }

        $Update->save();

        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('servicecategory.index');

    }

    public function destroy($id)
    {
        $Delete = ServiceCategory::find($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE, 'success');
        return redirect()->route('servicecategory.index');
    }
}
