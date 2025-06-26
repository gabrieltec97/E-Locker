<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;

class HomeController extends Controller
{
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    public function monthConverter()
    {
        $mes = date('M');

        $mes_extenso = array(
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Marco',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Nov' => 'Novembro',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Dec' => 'Dezembro'
        );

        return $mes_extenso["$mes"];
    }

     public function index()
    {
        $month = array(
            'Janeiro',
            'Fevereiro',
            'Marco',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Novembro',
            'Setembro',
            'Outubro',
            'Dezembro'
        );

        //Desenvolvimento do item 2
        $dataTotal = [];
        $dataTaken = [];

        foreach($month as $m) {
            $packets = DB::table('packets')
                ->where(function($query) {
                    $query->where('status', 'Retirado pelo destinatário')
                        ->orWhere('status', 'Retirado por terceiros');
                })
                ->where('month', $m)
                ->count();

            array_push($dataTaken, $packets);


            $packets = DB::table('packets')
                ->where('status', '!=', 'Cancelado')
                ->where('month', $m)
                ->count();

            array_push($dataTotal, $packets);
        }

        $day = date('d');

        //Desenvolvimento do item 1
        $totalReceivedToday = DB::table('packets')
                ->where('status', '!=', 'Cancelado')
                ->where('month', $this->monthConverter())
                ->where('day', $day)
                ->count();

        $totalTakenToday = DB::table('packets')
                ->where(function($query) {
                    $query->where('status', 'Retirado pelo destinatário')
                        ->orWhere('status', 'Retirado por terceiros');
                })
                ->where('month', $this->monthConverter())
                ->where('day', $day)
                ->count();

        //Desenvolvimento do item 4
        $total = DB::table('packets')
                ->where('status', '!=', 'Cancelado')
                ->where('month', $this->monthConverter())
                ->count();

        $totalWithdrawn = DB::table('packets')
                ->where(function($query) {
                    $query->where('status', 'Retirado pelo destinatário')
                        ->orWhere('status', 'Retirado por terceiros');
                })
                ->where('month', $this->monthConverter())
                ->count();

        $totalOthers = DB::table('packets')
                ->where('status', 'Retirado por terceiros')
                ->where('month', $this->monthConverter())
                ->count();

        $resume = DB::table('packets')
                ->where('status', '!=', 'Cancelado')
                ->where('month', $this->monthConverter())
                ->where('comments', '!=', null)
                ->count();

        $waiting = DB::table('packets')
                ->where('status', 'Aguardando Retirada')
                ->where('month', $this->monthConverter())
                ->count();

        $cancelled = DB::table('packets')
                ->where('status', 'Cancelado')
                ->where('month', $this->monthConverter())
                ->where('comments', '!=', null)
                ->count();

    //Desenvolvimento do item 3.
    $allUnits = [];
    $units = Unit::all();

    foreach($units as $unit){
        array_push($allUnits, $unit->number . ' - BL 0' . $unit->block);
    }

    $count = [];

    foreach($allUnits as $unicUnit){
        $countTotal = DB::table('packets')
            ->where('status', '!=', 'Cancelado')
            ->where('month', $this->monthConverter())
            ->where('unit', $unicUnit)
            ->count();

        $pickedUp = DB::table('packets')
                ->where(function($query) {
                    $query->where('status', 'Retirado pelo destinatário')
                        ->orWhere('status', 'Retirado por terceiros');
                })
                ->where('month', $this->monthConverter())
                 ->where('unit', $unicUnit)
                ->count();

        if($countTotal != 0){
            $percent = ($pickedUp * 100) / $countTotal;
            $percent = round($percent / 10) * 10;
        }else{
            $percent = 0;
        }

        array_push($count, ['unit' => $unicUnit, 'total' => $countTotal, 'pickedUp' => $pickedUp, 'percent' => $percent]);
    }

        // Ordenando o array $count pela quantidade total de itens, de forma decrescente.
        usort($count, function($a, $b) {
            return $b['total'] - $a['total'];
        });

        // Pegando os 5 primeiros itens (ou menos, se não houverem 5 unidades).
        $count = array_slice($count, 0, 5);

        return view('dashboard', [
            'dataTotal' => $dataTotal,
            'dataTaken' => $dataTaken,
            'totalReceivedToday' => $totalReceivedToday,
            'totalTakenToday' => $totalTakenToday,
            'resume' => $resume,
            'total' => $total,
            'totalOthers' => $totalOthers,
            'totalWithdrawn' => $totalWithdrawn,
            'cancelled' => $cancelled,
            'waiting' => $waiting,
            'count' => $count
        ]);
    }
}
