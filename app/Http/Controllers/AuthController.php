<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Survey;
use App\Overall;
use App\Overall2;
use App\Survey2;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB as FacadesDB;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)


    {


        $request->validate([
            'name' => 'required|string',
            'branch' => 'required|string',
            'username' => 'required|string|unique:users',
            'role' => 'required|string',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string'
        ]);

        $user = new User([

            'name' => $request->name,
            'branch_id' => $request->branch,
            'username' => $request->username,
            'role' => $request->role,
            'password' => bcrypt($request->password)

        ]);
        $user->save();
        /*
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
        */

        return redirect('/auth-login');

    }



    private function redirectToSuperAdminDashboard(){

        $FbTotal=0;
        $TikTotal=0;
        $InstTotal=0;
        $FriendTotal=0;
        $OthTotal=0;

        $yesTotal=0;
        $noTotal=0;

        $from = Carbon::parse("2021-1-1")->format("Y-m-d");
       $to = Carbon::parse("2021-2-1")->format("Y-m-d");


       $dates = array();
       $facebookDayByDay = array();
       $instagramDayByDay = array();
       $tiktokDayByDay = array();
       $friendDayByDay =  array();
       $otherDayByDay =  array();

       $dates2 = array();

       $yesDayByDay = array();
       $noDayByDay = array();
       ;


        $overall_collection = Overall::all();
        $overall_sorted_collection = $overall_collection->sortBy('date');
        $overall_size = $overall_collection->count();
        if($overall_size > 0){
        $latest_date_overall = $overall_sorted_collection->last();
  
         $FbTotal=$latest_date_overall->facebook;
         $TikTotal=$latest_date_overall->tiktok;
         $InstTotal=$latest_date_overall->instagram;
         $FriendTotal = $latest_date_overall->friend;
         $OthTotal=$latest_date_overall->other;
       }
       

       $dates = $overall_sorted_collection->pluck('date');
       $facebookDayByDay = $overall_sorted_collection->pluck('facebook');
       $instagramDayByDay = $overall_sorted_collection->pluck('instagram');
       $tiktokDayByDay = $overall_sorted_collection->pluck('tiktok');
       $friendDayByDay = $overall_sorted_collection->pluck('friend');
       $otherDayByDay = $overall_sorted_collection->pluck('other');


   

       for($i=$dates->count()-1 ; $i > 0  ; $i--){
        $facebookDayByDay[$i] = $facebookDayByDay[$i] - $facebookDayByDay[$i-1];
        $instagramDayByDay[$i] = $instagramDayByDay[$i] - $instagramDayByDay[$i-1];
        $tiktokDayByDay[$i] = $tiktokDayByDay[$i] - $tiktokDayByDay[$i-1];
        $friendDayByDay[$i] = $friendDayByDay[$i] - $friendDayByDay[$i-1];

        $otherDayByDay[$i] = $otherDayByDay[$i] - $otherDayByDay[$i-1];
       }

    //    dd($friendDayByDay);


       //question2 answers

       $overall_collection2 = Overall2::all();
       $overall_sorted_collection2 = $overall_collection2->sortBy('date');
       $overall_size2 = $overall_collection2->count();
       if($overall_size2 > 0){
       $latest_date_overall2 = $overall_sorted_collection2->last();
 
       $yesTotal = $latest_date_overall2->yes;
       $noTotal = $latest_date_overall2->no;
      }
      

      $dates2 = $overall_sorted_collection2->pluck('date');
      $yesDayByDay = $overall_sorted_collection2->pluck('yes');
      $noDayByDay = $overall_sorted_collection2->pluck('no');
    

      for($i=$dates2->count()-1 ; $i > 0  ; $i--){
       $yesDayByDay[$i] = $yesDayByDay[$i] - $yesDayByDay[$i-1];
       $noDayByDay[$i] = $noDayByDay[$i] - $noDayByDay[$i-1];
      }






    
    return view('/pages/dash-analysis',compact('FbTotal', 'TikTotal','InstTotal','FriendTotal','OthTotal','dates','facebookDayByDay'
    ,'instagramDayByDay','tiktokDayByDay','friendDayByDay','otherDayByDay','from','to','yesTotal','noTotal'
    ,'dates2' ,'yesDayByDay' , 'noDayByDay' ));

    }


    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            // Authentication not passed...
            return redirect('/auth-login');

        }

        $username=$request->username;

        $role = DB::table('users')->where('username', $username)->value('role');

       // $overall01 = DB::table('overalls')->where('date','2020-*')->first();

        if($role=='user'){
            $current_user = DB::table('users')->where('username', $username)->get();
            $company_id = DB::table('users')->where('username', $username)->value('id');
            $branch_id = DB::table('users')->where('username', $username)->value('branch_id');
            $name = DB::table('users')->where('username', $username)->value('name');

            $time = DB::table('users')->where('username', $username)->value('created_at');
            $datex = Carbon::parse($time);
            $date = $datex->format("Y-m-d");
            return view('/pages/dashboard-analytics', compact('company_id', 'branch_id','date'));
        }
        else{
            return $this->redirectToSuperAdminDashboard();
        }

    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }



    public function saveSurvey(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'fb' => 'required|string',
            'ig' => 'required|string',
            'tik' => 'required|string',
            'oth' => 'required|string',
            'friend' => 'required|string',
            'company_id'=> 'required|string',
            'branch_id'=> 'required|string',

        ]);


        $company_id=$request->company_id;
        $branch_id=$request->branch_id;

        $survey = new Survey([

            'company_id' => $request->company_id,
            'branch_id' => $request->branch_id,
            'facebook' => $request->fb,
            'instagram' => $request->ig,
            'tiktok' => $request->tik,
            'friend' => $request->friend,
            'other' => $request->oth

        ]);
        // dd($survey);
        $survey->save();




        ////////////////////////////////////



        $last_row = DB::table('surveys')->latest()->first();
        $time = $last_row->created_at;
        $datex = Carbon::parse($time);
        $date = $datex->format("Y-m-d");

        ////////////////////////////////////


        $current_date_row = DB::table('overalls')->where('date', $date)->first();
        //$rowsCount = $current_date_row->count();




         /*
            if the current date exist on the table
            we take it -> extract the old values ->
            add the new values -> update the row
            */


        if(!is_null($current_date_row)){


            $facebook = $current_date_row->facebook;
            $instagram = $current_date_row->instagram;
            $tiktok = $current_date_row->tiktok;
            $friend = $current_date_row->friend;
            $other = $current_date_row->other;

            $facebook=intval($facebook);
            $instagram=intval($instagram);
            $tiktok=intval($tiktok);
            $friend=intval($friend);

            $other=intval($other);

            $facebook2 = $last_row->facebook;
            $instagram2 = $last_row->instagram;
            $tiktok2 = $last_row->tiktok;
            $friend2 = $last_row->friend;
            $other2 = $last_row->other;

            $facebook2=intval($facebook2);
            $instagram2=intval($instagram2);
            $tiktok2=intval($tiktok2);
            $friend2=intval($friend2);
            $other2=intval($other2);


            $facebook2 = $facebook2+$facebook;
            $instagram2 = $instagram2+$instagram;
            $tiktok2 = $tiktok2+$tiktok;
            $friend2 = $friend2+$friend;
            $other2 =$other2+$other;



            DB::table('overalls')->where('date', $date)->update(['facebook' => $facebook2]);
            DB::table('overalls')->where('date', $date)->update(['instagram' => $instagram2]);
            DB::table('overalls')->where('date', $date)->update(['tiktok' => $tiktok2]);
            DB::table('overalls')->where('date', $date)->update(['friend' => $friend2]);
            DB::table('overalls')->where('date', $date)->update(['other' => $other2]);



             /*
            if the current date dose not exist
             we may be two cases:
                1-it is the first record at all
                2-it is the first record at this day


            if (1):
                we will git the values and add them to the table
            if (2):
                we will get the previous day overall and set them as the initial
            */
        }else{


            $date2 = Carbon::parse($date)->addDay();
            // $last_row_overall = $this->getLatestOverAllDate(date);
            $new_overall = DB::table('surveys')
            ->selectRaw('
                SUM(facebook) AS fb,
                SUM(instagram) AS ins,
                SUM(tiktok) AS tik,
                SUM(friend) AS friend,
                SUM(other) AS oth
            ')
            ->where('created_at', '<',$date2 )
            ->get();
            
            $overall = new Overall([
                'date' => $date,
                'facebook' => intval($new_overall[0]->fb),
                'instagram' => intval($new_overall[0]->ins),
                'tiktok' => intval($new_overall[0]->tik),
                'friend' => intval($new_overall[0]->friend),
                'other' => intval($new_overall[0]->oth)
            ]);


            $overall->save();



            //$rowsCountOverall = $last_row_overall->count();

        //     if(is_null($last_row_overall)){

        //         $facebook2 = $last_row->facebook;
        //         $instagram2 = $last_row->instagram;
        //         $tiktok2 = $last_row->tiktok;
        //         $other2 = $last_row->other;

        //         $facebook2=intval($facebook2);
        //         $instagram2=intval($instagram2);
        //         $tiktok2=intval($tiktok2);
        //         $other2=intval($other2);





        //   $overall = new Overall([

        //         'date' => $date,
        //         'facebook' => $facebook2,
        //         'instagram' => $instagram2,
        //         'tiktok' => $tiktok2,
        //         'other' => $other2


        //     ]);

        //     $overall->save();


        //   }
        // else{



        //     $facebook = $last_row_overall->facebook;
        //     $instagram = $last_row_overall->instagram;
        //     $tiktok = $last_row_overall->tiktok;
        //     $other = $last_row_overall->other;


        //     $facebook2 = $last_row->facebook;
        //     $instagram2 = $last_row->instagram;
        //     $tiktok2 = $last_row->tiktok;
        //     $other2 = $last_row->other;

        //     $facebook2=intval($facebook2);
        //     $instagram2=intval($instagram2);
        //     $tiktok2=intval($tiktok2);
        //     $other2=intval($other2);


        //     $facebook2 = $facebook2+$facebook;
        //     $instagram2 = $instagram2+$instagram;
        //     $tiktok2 = $tiktok2+$tiktok;
        //     $other2 =$other2+$other;




        //     $overall = new Overall([

        //         'date' => $date,
        //         'facebook' => $facebook2,
        //         'instagram' => $instagram2,
        //         'tiktok' => $tiktok2,
        //         'other' => $other2


        //     ]);

        //     $overall->save();




        // }





    }



    $this->addPreviousDatesToOverallTable($datex);

    // return view('/pages/dashboard-analytics', compact('company_id', 'branch_id','time'));
    return view('/pages/question2', compact('company_id', 'branch_id','time'));


}
    /**
     * add unexisted previous dates to the overall table as zero values
     *
     */

    private function addPreviousDatesToOverallTable($current_date){

        // $prev_date_carbon = $current_date->copy()->subDays(1);
        // $prev_date = $prev_date_carbon->format("Y-m-d");
        // $prev_date_row = DB::table('overalls')->where('date', $prev_date)->first();



        $initial_date = Carbon::createMidnightDate(2020, 1, 1)->format("Y-m-d");
        
        $it_date_row = DB::table('overalls')->where('date', $initial_date)->first();
        $it_date = Carbon::createMidnightDate(2020, 1, 1)->format("Y-m-d");
        $latest_row = ($it_date_row == null)? null :$it_date_row; 

        while(Carbon::parse($it_date)->diffInDays(Carbon::parse($current_date)) != 0 ){
            $current_date_row = DB::table('overalls')->where('date', $it_date)->first();
            if($current_date_row == null){
                $new_overall = DB::table('surveys')
                ->selectRaw('
                    SUM(facebook) AS fb,
                    SUM(instagram) AS ins,
                    SUM(tiktok) AS tik,
                    SUM(friend) AS friend,
                    SUM(other) AS oth
                ')
                ->where('created_at', '<', Carbon::parse($it_date)->addDay())
                ->get();
                
    
                $overall = new Overall([
                    'date' => $it_date,
                    'facebook' => (intval($new_overall[0]->fb) == null)? 0 : $new_overall[0]->fb,
                    'instagram' => (intval($new_overall[0]->ins) == null)? 0 : $new_overall[0]->ins,
                    'tiktok' => (intval($new_overall[0]->tik) == null)? 0 : $new_overall[0]->tik,
                    'friend' => (intval($new_overall[0]->friend) == null)? 0 : $new_overall[0]->friend,

                    'other' => (intval($new_overall[0]->oth) == null)? 0 : $new_overall[0]->oth,
                ]);
    
                $overall->save();
            }
            


            $it_date = Carbon::parse($it_date)->addDay()->format("Y-m-d");
            // $it_date_row = DB::table('overalls')->where('date', $it_date)->first();
        }


        // while($prev_date != Carbon::parse($initial_date)->subDay()->format("Y-m-d")){

        //   if($prev_date_row == null){
        //     DB::table('overalls')->insert([
        //       'date' => $prev_date_carbon->format("Y-m-d"),
        //       'facebook' =>  0,
        //       'instagram' =>  0,
        //       'tiktok' =>  0,
        //       'other' =>  0,
        //     ]);
        //   }
        //   $prev_date_carbon = $prev_date_carbon->subDays(1);
        //   $prev_date = $prev_date_carbon->format("Y-m-d");
        //   $prev_date_row = DB::table('overalls')->where('date', $prev_date)->first();

        // }

    }
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
      return response()->json($request->user());
    }


    //question 2 saving 
    public function saveSurvey2(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'yes' => 'required|string',
            'no' => 'required|string',
            'company_id'=> 'required|string',
            'branch_id'=> 'required|string',

        ]);


        $company_id=$request->company_id;
        $branch_id=$request->branch_id;

        $survey = new Survey2([

            'company_id' => $request->company_id,
            'branch_id' => $request->branch_id,
            'yes' => $request->yes,
            'no' => $request->no
        ]);

        $survey->save();




        ////////////////////////////////////



        $last_row = DB::table('survey2s')->latest()->first();
        $time = $last_row->created_at;
        $datex = Carbon::parse($time);
        $date = $datex->format("Y-m-d");

        ////////////////////////////////////


        $current_date_row = DB::table('overall2s')->where('date', $date)->first();
        //$rowsCount = $current_date_row->count();




         /*
            if the current date exist on the table
            we take it -> extract the old values ->
            add the new values -> update the row
            */


        if(!is_null($current_date_row)){


            $yes = $current_date_row->yes;
            $no = $current_date_row->no;
         

            $yes=intval($yes);
            $no=intval($no);
           
            $yes2 = $last_row->yes;
            $no2 = $last_row->no;
          
            $yes2=intval($yes2);
            $no2=intval($no2);
         

            $yes2 = $yes2+$yes;
            $no2 = $no2+$no;
           



            DB::table('overall2s')->where('date', $date)->update(['yes' => $yes2]);
            DB::table('overall2s')->where('date', $date)->update(['no' => $no2]);




             /*
            if the current date dose not exist
             we may be two cases:
                1-it is the first record at all
                2-it is the first record at this day


            if (1):
                we will git the values and add them to the table
            if (2):
                we will get the previous day overall and set them as the initial
            */
        }else{


            $date2 = Carbon::parse($date)->addDay();
            // $last_row_overall = $this->getLatestOverAllDate(date);
            $new_overall = DB::table('survey2s')
            ->selectRaw('
                SUM(yes) AS yesSum,
                SUM(no) AS noSum
            ')
            ->where('created_at', '<',$date2 )
            ->get();
            
            $overall = new Overall2([
                'date' => $date,
                'yes' => intval($new_overall[0]->yesSum),
                'no' => intval($new_overall[0]->noSum)
            ]);

            $overall->save();



            //$rowsCountOverall = $last_row_overall->count();

        //     if(is_null($last_row_overall)){

        //         $facebook2 = $last_row->facebook;
        //         $instagram2 = $last_row->instagram;
        //         $tiktok2 = $last_row->tiktok;
        //         $other2 = $last_row->other;

        //         $facebook2=intval($facebook2);
        //         $instagram2=intval($instagram2);
        //         $tiktok2=intval($tiktok2);
        //         $other2=intval($other2);





        //   $overall = new Overall([

        //         'date' => $date,
        //         'facebook' => $facebook2,
        //         'instagram' => $instagram2,
        //         'tiktok' => $tiktok2,
        //         'other' => $other2


        //     ]);

        //     $overall->save();


        //   }
        // else{



        //     $facebook = $last_row_overall->facebook;
        //     $instagram = $last_row_overall->instagram;
        //     $tiktok = $last_row_overall->tiktok;
        //     $other = $last_row_overall->other;


        //     $facebook2 = $last_row->facebook;
        //     $instagram2 = $last_row->instagram;
        //     $tiktok2 = $last_row->tiktok;
        //     $other2 = $last_row->other;

        //     $facebook2=intval($facebook2);
        //     $instagram2=intval($instagram2);
        //     $tiktok2=intval($tiktok2);
        //     $other2=intval($other2);


        //     $facebook2 = $facebook2+$facebook;
        //     $instagram2 = $instagram2+$instagram;
        //     $tiktok2 = $tiktok2+$tiktok;
        //     $other2 =$other2+$other;




        //     $overall = new Overall([

        //         'date' => $date,
        //         'facebook' => $facebook2,
        //         'instagram' => $instagram2,
        //         'tiktok' => $tiktok2,
        //         'other' => $other2


        //     ]);

        //     $overall->save();




        // }





    }



    $this->addPreviousDatesToOverall2Table($datex);

    return view('/pages/dashboard-analytics', compact('company_id', 'branch_id','time'));


}



/**
     * add unexisted previous dates to the overall table as zero values
     *
     */

    private function addPreviousDatesToOverall2Table($current_date){

        $initial_date = Carbon::createMidnightDate(2020, 1, 1)->format("Y-m-d");
        
        $it_date_row = DB::table('overall2s')->where('date', $initial_date)->first();
        $it_date = Carbon::createMidnightDate(2020, 1, 1)->format("Y-m-d");
        $latest_row = ($it_date_row == null)? null :$it_date_row; 

        while(Carbon::parse($it_date)->diffInDays(Carbon::parse($current_date)) != 0 ){
            $current_date_row = DB::table('overall2s')->where('date', $it_date)->first();
            if($current_date_row == null){
                $new_overall = DB::table('survey2s')
                ->selectRaw('
                    SUM(yes) AS yes,
                    SUM(no) AS no
                ')
                ->where('created_at', '<', Carbon::parse($it_date)->addDay())
                ->get();
                
    
                $overall = new Overall2([
                    'date' => $it_date,
                    'yes' => (intval($new_overall[0]->yes) == null)? 0 : $new_overall[0]->yes,
                    'no' => (intval($new_overall[0]->no) == null)? 0 : $new_overall[0]->no,
                ]);
    
                $overall->save();
            }
            


            $it_date = Carbon::parse($it_date)->addDay()->format("Y-m-d");
        }

    }


}
