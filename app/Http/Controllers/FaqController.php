<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $All = Faq::orderBy('rank')->get();
        return view('backend.faq.index', compact('All'));
    }

    public function create()
    {
        return view('backend.faq.create');
    }


    public function store(Request $request)
    {
       $New = Faq::create($request->except('_token'));
        $New->save();
        toast(SWEETALERT_MESSAGE_CREATE,'success');
        return redirect()->route('faq.index');

    }


    public function show($id)
    {
        $Show = Faq::findOrFail($id);
        return view('frontend.faq.index', compact('Show'));

    }

    public function edit($id)
    {
        $Edit = Faq::findOrFail($id);
        return view('backend.faq.edit', compact('Edit'));
    }

    public function update(Request $request, Faq $Update)
    {
        $Update->update($request->except('_token', '_method'));
        $Update->save();

        toast(SWEETALERT_MESSAGE_UPDATE,'success');
        return redirect()->route('faq.index');

    }

    public function destroy($id)
    {
        $Delete = Faq::findOrFail($id);
        $Delete->delete();

        toast(SWEETALERT_MESSAGE_DELETE,'success');
        return redirect()->route('faq.index');
    }

    public function getOrder(Request $request){
        foreach($request->get('faq') as  $key => $rank ){
            Faq::where('id',$rank)->update(['rank'=>$key]);
        }
    }

    public function getSwitch(Request $request){
        $update=Faq::findOrFail($request->id);
        $update->status = $request->status == "true" ? 1 : 0 ;
        $update->save();
    }

}
