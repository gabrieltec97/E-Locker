<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Packet;

class Unit extends Model
{
    public function packets()
    {
        return $this->hasMany(Packet::class, 'unit', 'id');
    }
}
