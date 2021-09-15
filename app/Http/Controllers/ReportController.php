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
        $year = ['2015','2016','2017','2018','2019','2020'];

        $bid = [];
        foreach ($year as $key => $value) {
            $bid[] = Bid::where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
        }

        return view('report')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($bid,JSON_NUMERIC_CHECK));
    }
}
