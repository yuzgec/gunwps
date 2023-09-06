<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Changevat extends Component
{
    public bool $extvat = true;
    public object $product;

    public function toggle(){
        $this->extvat = !$this->extvat;
    }

    public function render()
    {
        return view('livewire.changevat');
    }
}
