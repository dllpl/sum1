<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
//    public function index()
//    {
//        $auth = Auth::user();
//        if ($auth) {
//            if ($auth->hasRole('admin')) {
//                return view('report', ['bids' => DB::table('Bids')->orderBy('created_at', 'DESC')->get()]);
//            } else return view('dashboard');
//        } else return view('auth.login');
//
//
//    }
    public function index()
    {
        $auth = Auth::user();
        if ($auth) {
            if ($auth->hasRole('admin')) {

                $dates = [];
                $bids_date = Bid::all()->groupBy(function ($item) {
                    return $item->created_at->format('d-M');
                })->toArray();
                $reversed_array = array_reverse($bids_date);

                $days = array_keys($reversed_array);

                $big_in_day = [];
                for ($i = 0; $i < count($days); $i++) {
                    array_push($big_in_day, count($reversed_array[$days[$i]]));
                }
//                $days = implode(';', $days);
//                $big_in_day = implode(';', $big_in_day);


                return view('report')->with('days',json_encode($days,JSON_NUMERIC_CHECK))->with('bid_in_days',json_encode($big_in_day,JSON_NUMERIC_CHECK));

            } else return view('dashboard');
        } else return view('auth.login');

//        return view('report')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($bid,JSON_NUMERIC_CHECK));
    }
}
