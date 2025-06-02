<?php

namespace App\Livewire;

use App\Models\Packet;
use Livewire\Component;

class Packets extends Component
{
    public $searchTerm = '';
    public $packets;

    public function render()
    {
        $this->packets = Packet::where('id', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('unit', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('owner', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('received_at', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('received_by', 'like', '%'.$this->searchTerm.'%')
            ->get();

        return view('livewire.packets');
    }
}
