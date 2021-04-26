<?php

namespace App\Http\Controllers;

use App\Overall;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function getDataInRange(Request $request){
        $inputs = $request->all();
        $from = $inputs['from'];
        $to = $inputs['to'];

        $from_carbon = Carbon::parse($from);
        $to_carbon = Carbon::parse($to);

        $overalls = Overall::all();
        $inrange_overall = array();
        foreach($overalls as $overall){
            $curr_date = $overall->getCarbonDate();
            if($from_carbon->lessThanOrEqualTo($curr_date) && $to_carbon->greaterThanOrEqualTo($curr_date)){
                array_push($inrange_overall,$overall);
            }
        }
        $from_overall = DB::table('overalls')->where('date',$from)->first();
        $to_overall = DB::table('overalls')->where('date',$to)->first();
        $FbTotal=0;
        $TikTotal=0;
        $InstTotal=0;
        $OthTotal=0;

        if($from_overall != null && $to_overall != null){
            $FbTotal = $from_overall->facebook - $to_overall->facebook;
            $TikTotal = $from_overall->tiktok - $to_overall->tiktok;
            $InstTotal = $from_overall->instagram - $to_overall->instagram;
            $OthTotal = $from_overall->other - $to_overall->other;
        }elseif($from_overall === null && $to_overall != null){
            $FbTotal=$to_overall->facebook;
            $TikTotal=$to_overall->tiktok;
            $InstTotal=$to_overall->instagram;
            $OthTotal=$to_overall->other;
        }elseif($from_overall != null && $to_overall === null){
            $FbTotal=$from_overall->facebook;
            $TikTotal=$from_overall->tiktok;
            $InstTotal=$from_overall->instagram;
            $OthTotal=$from_overall->other;
        }else{
            $all_overAll = Overall::all();
            $max_overall_date = $from_carbon;
            $max_overall = null;
            foreach($all_overAll as $overall){
                $curr_date = $overall->getCarbonDate();
                if($from_carbon->lessThanOrEqualTo($curr_date) && $to_carbon->greaterThanOrEqualTo($curr_date)){
                    if($max_overall_date->lessThanOrEqualTo($curr_date)){
                        $max_overall_date = $curr_date;
                        $max_overall = $overall;
                    }
                }
            }
            if($max_overall != null){
                $FbTotal=$max_overall->facebook;
                $TikTotal=$max_overall->tiktok;
                $InstTotal=$max_overall->instagram;
                $OthTotal=$max_overall->other;
            }
        }
      
      
       $overalls = collect($inrange_overall);
       $dates = $overalls->pluck('date');
       $facebookDayByDay = $overalls->pluck('facebook');
       $instagramDayByDay = $overalls->pluck('instagram');
       $tiktokDayByDay =$overalls->pluck('tiktok');
       $otherDayByDay = $overalls->pluck('other');

       return view('/pages/dash-analysis',compact('FbTotal', 'TikTotal','InstTotal','OthTotal','dates','facebookDayByDay'
       ,'instagramDayByDay','tiktokDayByDay','otherDayByDay','from','to'));

    }


    // Dashboard - Analytics
    public function dashboardAnalytics(){
        $pageConfigs = [
            'pageHeader' => false
        ];
      
        /*
        return view('pages/thanks-page');
        sleep(3);
*/
        return view('/pages/dashboard-analytics', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    // Dashboard - Analytics
    public function dashboardAnalysis(){
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/dash-analysis', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    

    // Dashboard - Ecommerce
    public function dashboardEcommerce(){
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/dashboard-ecommerce', [
            'pageConfigs' => $pageConfigs
        ]);
    }


    public function thanks(){
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/thanks-page', [
            'pageConfigs' => $pageConfigs
        ]);
    }



}

