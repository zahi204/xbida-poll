<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
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

