<?php

namespace App\Livewire;

use App\Models\Unit;
use Livewire\Component;

class Units extends Component
{
    public $searchTerm = '';
    public $units;

    public function render()
    {
        $this->units = Unit::where('number', 'like', '%'.$this->searchTerm.'%')->get();
        return view('livewire.units');
    }
}
