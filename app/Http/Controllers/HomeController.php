<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $count_all =invoices::count();
        $paiinvoice= invoices::all();

        $piebenefice=0;
        $pieshipping=0;
        $piesubtotal=0;

        foreach ($paiinvoice as $p){
        $piebenefice=$p->total_ben + $piebenefice;
        $pieshipping=$p->shipping + $pieshipping;
        $piesubtotal=$p->sub_total + $piesubtotal;
        }
  $piecosts=$piesubtotal-$piebenefice;
        
  
  
          
  
  
          $chartjs_2 = app()->chartjs
              ->name('pieChartTest')
              ->type('pie')
              ->size(['width' => 340, 'height' => 200])
              ->labels(['Coûts des produits', 'Frais de livraison','Bénéfice Net'])
              ->datasets([
                  [
                      'backgroundColor' => ['#F8617A', '#2FC091','#F09C57'],
                      'data' => [$piecosts, $pieshipping,$piebenefice]
                  ]
              ])
              ->options([]);

        $invoices = invoices::orderBy('id', 'desc')->take(5)->get();
        return view('home',compact('invoices','chartjs_2'));
    }
}
