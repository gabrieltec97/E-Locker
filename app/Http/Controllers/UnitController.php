<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $check = DB::table('units')
            ->where('number', $request->unit)
            ->where('block', $request->block)
            ->count();

        if ($check != 0){
            return redirect()->back()->with('msg-error', 'Unidade já cadastrada no sistema!');
        }

        $unit = new Unit();
        $unit->number = $request->unit;
        $unit->block = $request->block;
        $unit->save();

        return redirect()->back()->with('msg-success', 'Unidade cadastrada com sucesso!');
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
