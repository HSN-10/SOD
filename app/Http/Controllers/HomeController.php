<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $now = Carbon::now();
        $user = Auth::user();
        $amounts = $user->amounts()->whereYear('created_at', '=', $now->year)
                        ->whereMonth('created_at', '=', $now->month)
                        ->orderBy('created_at', 'DESC')
                        ->get();

        $total = [
            'Driver' => $amounts->where('typeOfamount', '=', 1)->sum('amount'),
            'Shop'   => $amounts->where('typeOfamount', '=', 2)->sum('amount'),
            'all'    => $amounts->sum('amount')
        ];
        
        return view('home', compact(['amounts', 'total']));
    }
    public function store(Request $req){
        $user = Auth::user();
        if($req->amount){
            if($req->type==1){
                // Delivery 
                $amount = $user->amounts()->create(['amount'=>$req->amount,'note'=>$req->note,'typeOfamount'=>1]);
            }elseif($req->type==2){
                // Purchase
                $amount = $user->amounts()->create(['invoice'=>$req->invoice,'company'=>$req->company,'amount'=>$req->amount,'note'=>$req->note,'typeOfamount'=>2]);
            }else{
                $amount = false;
            }
        }
        
        return redirect()->back();
    }
    public function report($year = null,$month = null){
        $user = Auth::user();
        
        if($year && $month){
            $amounts = $user->amounts()->whereYear('created_at', '=', $year)
                            ->whereMonth('created_at', '=', $month)
                            ->orderBy('created_at', 'DESC')
                            ->get();
    
            $total = [
                'Driver' => $amounts->where('typeOfamount', '=', 1)->sum('amount'),
                'Shop'   => $amounts->where('typeOfamount', '=', 2)->sum('amount'),
                'all'    => $amounts->sum('amount')
            ];
            
            return view('home', compact(['amounts', 'total']));
        }elseif($year && !$month){
            $records = $user->amounts()
                        ->where('user_id', '=', $user->id)
                        ->orderBy('created_at', 'DESC')
                        ->whereYear('created_at', '=', $year)
                        ->get()->groupBy(function ($date){
                return Carbon::parse($date->created_at)->format('m-Y');
            });
        }else{
            $records = $user->amounts()
                        ->where('user_id', '=', $user->id)
                        ->orderBy('created_at', 'DESC')
                        ->get()->groupBy(function ($date){
                return Carbon::parse($date->created_at)->format('m-Y');
            });
        }
        $cards = [];
        foreach($records as $key => $record){
            $amounts = ['d'=>[],'p'=>[]];
            foreach($record as $amount){
                if($amount->typeOfamount == 1){
                    array_push($amounts['d'],$amount->amount);
                }elseif($amount->typeOfamount == 2){
                    array_push($amounts['p'],$amount->amount);
                }
            }
            $d = array_sum($amounts['d']);
            $p = array_sum($amounts['p']);
            $key = explode('-',$key);
            $m = $key[0];
            $y = $key[1];

            array_push($cards,array('m'=>$m,'y'=>$y,'d'=>$d,'p'=>$p,'t'=>$d+$p));
        }

        if($cards){
            return view('report', compact('cards'));
        }else{
            return redirect()->back();
        }
    }
}
