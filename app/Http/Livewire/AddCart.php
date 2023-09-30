<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Cart;
use Livewire\Component;

class AddCart extends Component
{

    public object $product;
    public object $c;

    public function add(){

        $p = Product::with('getBrand')->whereHas('translations', function ($query) {
            $query->where('slug', $this->product->slug);
        })->first();

        views($p)->collection('addCart')->record();

        \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->add(
            [
                'id' => $p->id,
                'name' => $p->title,
                'price' => $p->price,
                'weight' => 0,
                'qty' => 1,
                'options' => [
                    'image' => (!$p->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg' : $p->getFirstMediaUrl('page', 'small'),
                    'lang' => config('app.locale'),
                    'url' => $this->product->slug,
                    'brand' => $p->getBrand->title,
                    'brandImage' => $p->getBrand->getFirstMediaUrl('page','small'),
                    'category' => $this->c->slug,
                ]
            ]);


        return alert()->html('Added','<b>'.$p->title.'</b> Product have added to your cart.')->success()->autoClose(2000);

    }

    public function render()
    {
        return view('livewire.add-cart');
    }
}
