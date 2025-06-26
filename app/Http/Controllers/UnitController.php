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

    public function store(Request $request)
    {
        $request->validate([
            'unit' => 'required',
            'block' => 'required',
        ], [
            'unit.required' => 'Unidade não cadastrada. O número da unidade é obrigatório.',
            'block.required' => 'Bloco não cadastrado. O número do bloco é obrigatório.',
        ]);

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

    public function show(string $id)
    {
        //Estamos utilizando deleção aqui por conta do livewire não aceitar método de delete.
        $unit = Unit::find($id);
        $unit->delete();

        return redirect()->back()->with('msg-success', 'Unidade deletada com sucesso!');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'unit' => 'required',
            'block' => 'required',
        ], [
            'unit.required' => 'Alteração não concluída. O número da unidade é obrigatório.',
            'block.required' => 'Alteração não concluída. O número do bloco é obrigatório.',
        ]);

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

        return redirect()->back()->with('msg-success', 'Alterações realizadas com sucesso!');
    }

    public function destroy(string $id)
    {
        $unit = Unit::find($id);
        $unit->delete();

        return redirect()->back()->with('msg-success', 'Unidade deletada com sucesso!');
    }
}
