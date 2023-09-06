<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Redirect;

class BlogCategoryController extends Controller
{

    public function index()
    {
        $All = BlogCategory::get()->toFlatTree();
        return view('backend.blogcategory.index', compact('All'));
    }

    public function create()
    {
        $Kategori = BlogCategory::all();
        return view('backend.blogcategory.create', compact('Kategori'));
    }

    public function store(BlogCategoryRequest $request)
    {
        $New = BlogCategory::create($request->except('_token', 'image', 'gallery'));

        if ($request->image) {
            $New->addMedia($request->image)->toMediaCollection();
        }

        if ($request->parent_id) {
            $node = BlogCategory::find($request->parent_id);
            $node->appendNode($New);
        }

        toast(SWEETALERT_MESSAGE_CREATE, 'success');
        return redirect()->route('blog-categories.index');

    }

    public function show($id)
    {
        $Show = BlogCategory::findOrFail($id);
        return view('frontend.blogcategory.index', compact('Show'));
    }

    public function edit($id)
    {
        $Edit = BlogCategory::findOrFail($id);
        $Kategori = BlogCategory::all();

        return view('backend.blogcategory.edit', compact('Edit', 'Kategori'));
    }

    public function update(BlogCategoryRequest $request, $id)
    {

        $Update = BlogCategory::findOrFail($id);

        $Update->title = $request->title;
        $Update->short = $request->short;
        $Update->desc = $request->desc;

        $Update->seo1 = $request->seo1;
        $Update->seo2 = $request->seo2;
        $Update->seo3 = $request->seo3;

        $Update->parent_id = $request->parent_id;

        $Update->save();

        if ($request->hasFile('image')) {
            $Update->media()->delete();
            $Update->addMedia($request->image)->toMediaCollection();
        }

        if ($request->parent) {
            $node = BlogCategory::find($request);
            $node->appendNode($Update);
        }

        toast(SWEETALERT_MESSAGE_UPDATE, 'success');
        return redirect()->route('blog-categories.index');

    }

    public function destroy($id)
    {
        $Delete = BlogCategory::find($id);
        if ($Delete->getCategoryCount() > 0) {
            alert()->error('Silinemez', 'Kategoriye ait sayfa bulunmaktadır.');
            return Redirect::back();
        }
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE, 'success');
        return redirect()->route('blog-categories.index');
    }
}
