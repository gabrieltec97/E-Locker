<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('dashboard', [
            'dataTotal' => $dataTotal,
            'dataTaken' => $dataTaken,
            'totalReceivedToday' => $totalReceivedToday,
            'totalTakenToday' => $totalTakenToday
        ]);
    }

}
