<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecordResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $now = Carbon::now();
        $user = Auth::user();
        $amounts = $user->amounts()->whereYear('created_at', '=', $now->year)
            ->whereMonth('created_at', '=', $now->month)
            ->orderBy('created_at', 'DESC')
            ->get();

        $total = [
            'Delivery'    => $amounts->where('typeOfamount', '=', 1)->sum('amount'),
            'Purchase'      => $amounts->where('typeOfamount', '=', 2)->sum('amount'),
            'Total'       => $amounts->sum('amount')
        ];

        return [
            'Total'     => $total,
            'Records'   => RecordResource::collection($amounts)
        ];
    }

    public function report($year = null, $month = null)
    {
        $user = Auth::user();

        if ($year && $month) {
            $amounts = $user->amounts()->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $month)
                ->orderBy('created_at', 'DESC')
                ->get();

            $total = [
                'Delivery' => $amounts->where('typeOfamount', '=', 1)->sum('amount'),
                'Purchase'   => $amounts->where('typeOfamount', '=', 2)->sum('amount'),
                'Total'    => $amounts->sum('amount')
            ];

            return [
                'Total'     => $total,
                'Records'   => RecordResource::collection($amounts)
            ];
        } elseif ($year && !$month) {
            $records = $user->amounts()
                ->where('user_id', '=', $user->id)
                ->orderBy('created_at', 'DESC')
                ->whereYear('created_at', '=', $year)
                ->get()->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('m-Y');
                });
        } else {
            $records = $user->amounts()
                ->where('user_id', '=', $user->id)
                ->orderBy('created_at', 'DESC')
                ->get()->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('m-Y');
                });
        }
        $cards = [];
        foreach ($records as $key => $record) {
            $amounts = ['d' => [], 'p' => []];
            foreach ($record as $amount) {
                if ($amount->typeOfamount == 1) {
                    array_push($amounts['d'], $amount->amount);
                } elseif ($amount->typeOfamount == 2) {
                    array_push($amounts['p'], $amount->amount);
                }
            }
            $d = array_sum($amounts['d']);
            $p = array_sum($amounts['p']);
            $key = explode('-', $key);
            $m = $key[0];
            $y = $key[1];

            array_push($cards, array('Month' => $m, 'Year' => $y, 'Delivery' => $d, 'Purchase' => $p, 'Total' => $d + $p));
        }

        if ($cards) {
            return $cards;
        } else {
            return ['redirect()->back()'];
        }
    }


    public function store(Request $req)
    {
        $user = Auth::user();
        $validate = $req->validate([
            'type' => 'required',
            'amount' => 'required'
        ]);
        if ($req->amount) {
            if ($req->type == 1) {
                // Delivery
                $amount = $user->amounts()->create(['amount' => $req->amount, 'note' => $req->note, 'typeOfamount' => 1]);
            } elseif ($req->type == 2) {
                // Purchase
                $amount = $user->amounts()->create(['invoice' => $req->invoice, 'company' => $req->company, 'amount' => $req->amount, 'note' => $req->note, 'typeOfamount' => 2]);
            } else {
                $amount = false;
            }
        }

        return new RecordResource($amount);
    }
}
