<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use App\Models\Unit;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    public function index()
    {
        return view('Packets.historic');
    }

    public function create()
    {
        $units = Unit::all();
        return view('Packets.new-packet', [
            'units' => $units
        ]);
    }

    public function store(Request $request)
    {
        $packet = new Packet();
        $packet->unit = $request->unit;
        $packet->owner = $request->recipient;
        $packet->received_by = $request->receiver;
        $packet->comments = $request->comments;
        $packet->status = 'Aguardando Retirada';
        $packet->received_at = date('d/m/Y - H:i:s');
        $packet->save();

        return redirect()->back()->with('msg-success', 'Entrega cadastrada com sucesso!');
    }

    public function show(Packet $packet)
    {
        //
    }

    public function edit(Packet $packet)
    {
        //
    }

    public function update(Request $request, Packet $packet)
    {
        //
    }

    public function destroy(Packet $packet)
    {
        //
    }
}
