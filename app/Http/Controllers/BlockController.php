<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlockController extends Controller
{
    public function store(Request $request)
    {
        $check = DB::table('blocks')
            ->where('number', $request->block)
            ->count();

        if ($check != 0){
            return redirect()->back()->with('msg-error', 'Bloco já cadastrado no sistema!');
        }

        $block = new Block();
        $block->number = $request->block;
        $block->save();

        return redirect()->back()->with('msg-success', 'Bloco cadastrado com sucesso!');;
    }

    public function destroy(string $id)
    {
        $block = Block::find($id);
        $block->delete();

        return redirect()->back()->with('msg-success', 'Bloco deletado com sucesso!');
    }
}
