<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $blocks = Block::all();
        return view('Units.unidades', [
            'blocks' => $blocks
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $unit = new Unit();
        $unit->number = $request->unit;
        $unit->block = $request->block;
        $unit->save();

        return redirect()->back();
    }

    public function show(Unit $unit)
    {
        //
    }

    public function edit(Unit $unit)
    {
        //
    }

    public function update(Request $request, Unit $unit)
    {
        //
    }

    public function destroy(Unit $unit)
    {
        //
    }
}
