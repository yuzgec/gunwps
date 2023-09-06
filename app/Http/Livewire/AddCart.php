<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Cart;
use Livewire\Component;

class AddCart extends Component
{

    public object $product;

    public function add($url){

        dd($url);

        $p = Product::with('getBrand')->whereHas('translations', function ($query) use ($url) {
            $query->where('slug', request($url));
        })->first();

        Cart::instance('shopping')->add(
            [
                'id' => $p->id,
                'name' => $p->title,
                'price' => $p->price,
                'weight' => 0,
                'qty' => 1,
                'options' => [
                    'image' => (!$p->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg' : $p->getFirstMediaUrl('page', 'small'),
                    'lang' => config('app.locale'),
                    'url' => $p->slug
                ]
            ]);

        $this->emit('addCart');

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.add-cart');
    }
}
