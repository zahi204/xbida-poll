<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{


    // Dashboard - Ecommerce
    public function mainpage(){
        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/main', [
            'pageConfigs' => $pageConfigs
        ]);
    }

        // Dashboard - Ecommerce
        public function loginpage(){
            $pageConfigs = [
                'pageHeader' => false
            ];
    
            return view('/pages/loginpage', [
                'pageConfigs' => $pageConfigs
            ]);
        }


}
