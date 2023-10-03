<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class TaxAdd extends Component
{
    public Product $product;
    public $vergiEklendi = false; // Vergi durumu

    public function toggleVergi()
    {
        $this->vergiEklendi = !$this->vergiEklendi;
        if ($this->vergiEklendi) {
            $this->product->price = $this->product->price * 1.21; // %21 vergi ekler
        } else {
            $this->product->price = round($this->product->price / 1.21); // Vergiyi kaldırır
        }
    }
    public function render()
    {
        return view('livewire.tax-add');
    }
}
