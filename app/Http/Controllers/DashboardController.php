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
            $FbTotal = $to_overall->facebook - $from_overall->facebook;
            $TikTotal = $to_overall->tiktok - $from_overall->tiktok;
            $InstTotal = $to_overall->instagram - $from_overall->instagram;
            $OthTotal = $to_overall->other - $from_overall->other;
        }elseif($from_overall == null && $to_overall != null){
            $FbTotal=$to_overall->facebook;
            $TikTotal=$to_overall->tiktok;
            $InstTotal=$to_overall->instagram;
            $OthTotal=$to_overall->other;
        }elseif($from_overall != null && $to_overall == null){
            $overall_collection = Overall::all();
            $overall_sorted_collection = $overall_collection->sortBy('date');
       
            $latest_date_overall = $overall_sorted_collection->last();

            $FbTotal=$latest_date_overall->facebook;
            $TikTotal=$latest_date_overall->tiktok;
            $InstTotal=$latest_date_overall->instagram;
            $OthTotal=$latest_date_overall->other;
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
      
      
       $overall_collection = collect($inrange_overall);

       $overall_sorted_collection = $overall_collection->sortBy('date');

       $dates = $overall_sorted_collection->pluck('date');
       $facebookDayByDay = $overall_sorted_collection->pluck('facebook');
       $instagramDayByDay = $overall_sorted_collection->pluck('instagram');
       $tiktokDayByDay = $overall_sorted_collection->pluck('tiktok');
       $otherDayByDay = $overall_sorted_collection->pluck('other');

       for($i=$dates->count()-1 ; $i > 0  ; $i--){
        $facebookDayByDay[$i] = $facebookDayByDay[$i] - $facebookDayByDay[$i-1];
        $instagramDayByDay[$i] = $instagramDayByDay[$i] - $instagramDayByDay[$i-1];
        $tiktokDayByDay[$i] = $tiktokDayByDay[$i] - $tiktokDayByDay[$i-1];
        $otherDayByDay[$i] = $otherDayByDay[$i] - $otherDayByDay[$i-1];
       }
       //fix 0th date
       if($dates->count() > 0){
        $prev_of_zero = Carbon::parse($dates[0])->subDay()->format("Y-m-d");
        $zero_prev_row = DB::table('overalls')->where('date', $prev_of_zero)->first();
        if(!is_null($zero_prev_row)){
         $facebookDayByDay[0] = $facebookDayByDay[0] - $zero_prev_row->facebook;
         $instagramDayByDay[0] = $instagramDayByDay[0] - $zero_prev_row->instagram;
         $tiktokDayByDay[0] = $tiktokDayByDay[0] - $zero_prev_row->tiktok;
         $otherDayByDay[0] = $otherDayByDay[0] - $zero_prev_row->other;
        }
       }
       


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

