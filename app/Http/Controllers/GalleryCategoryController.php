<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class GalleryCategoryController extends Controller
{


    public function index()
    {
        $All = GalleryCategory::get()->toFlatTree();
        return view('backend.gallerycategory.index', compact('All'));
    }

    public function create()
    {
        $Kategori = GalleryCategory::all();
        return view('backend.gallerycategory.create', compact('Kategori'));
    }

    public function store(Request $request)
    {
        $New = GalleryCategory::create($request->except('_token', 'image', 'gallery'));

        if ($request->image) {

            $New->addMedia($request->image)->toMediaCollection();
        }

        if ($request->parent_id) {
            $node = GalleryCategory::find($request->parent_id);
            $node->appendNode($New);
        }

        toast(SWEETALERT_MESSAGE_CREATE, 'success');
        return redirect()->route('gallery-categories.index');

    }


    public function show($id)
    {
        $Show = GalleryCategory::findOrFail($id);
        return view('frontend.gallerycategory.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = GalleryCategory::findOrFail($id);
        $Kategori = GalleryCategory::all();

        return view('backend.gallerycategory.edit', compact('Edit', 'Kategori'));
    }

    public function update(Request $request, GalleryCategory $Update)
    {
        $Update->update($request->except('_token', '_method', 'image'));

        if ($request->hasFile('image')) {
            $Update->media()->where('collection_name', 'page')->delete();
            $Update->addMedia($request->image)->toMediaCollection('page');
        }

        if ($request->parent) {
            $node = GalleryCategory::find($request);
            $node->appendNode($Update);
        }

        $Update->save();

        toast(SWEETALERT_MESSAGE_UPDATE, 'success');
        return redirect()->route('gallery-categories.index');

    }

    public function destroy($id)
    {
        $Delete = GalleryCategory::find($id);
        if ($Delete->getCategoryCount() > 0) {
            alert()->error('Silinemez', 'Kategoriye ait sayfa bulunmaktadır.');
            return redirect()->back();
        }
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE, 'success');
        return redirect()->route('gallery-categories.index');
    }
}
