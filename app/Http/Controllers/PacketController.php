<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('Packets.new-packet');
    }

    public function store(Request $request)
    {
        //
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
