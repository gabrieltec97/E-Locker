<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use App\Models\Unit;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Packets.historic');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        return view('Packets.new-packet', [
            'units' => $units
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $packet = Packet::find($id);

        return view('Packets.packet', [
            'packet' => $packet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
