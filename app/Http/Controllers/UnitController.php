<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        return view('Units.unidades');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
