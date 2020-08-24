<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Survey;
use App\Overall;

use DB;

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
            return Session::flash('message', 'This is a message!');         
        }

        $username=$request->username;

        $role = DB::table('users')->where('username', $username)->value('role');
        $current_user = DB::table('users')->where('username', $username)->get();

        
        $company_id = DB::table('users')->where('username', $username)->value('id');
        $branch_id = DB::table('users')->where('username', $username)->value('branch_id');
        $name = DB::table('users')->where('username', $username)->value('name');

        $time = DB::table('users')->where('username', $username)->value('created_at');
        $datex = Carbon::parse($time);
        $date = $datex->format("Y-m-d");

        $last_row = DB::table('users')->latest()->first();
        $omar = $last_row->name;

        $overall = DB::table('overalls')->latest()->first();
       // Overall::latest();
        
        $FbTotal=$overall->facebook;
        $TikTotal=$overall->tiktok;
        $InstTotal=$overall->instagram;
        $OthTotal=$overall->other;

       // $overall01 = DB::table('overalls')->where('date','2020-*')->first();

        if($role=='user'){
            return view('/pages/dashboard-analytics', compact('company_id', 'branch_id','date','omar'));
        } 
        else{

            return view('/pages/dash-analysis',compact('FbTotal', 'TikTotal','InstTotal','OthTotal'));

        }

        /*
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

        */
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
        $request->validate([
            'fb' => 'required|string',
            'ig' => 'required|string',
            'tik' => 'required|string',
            'oth' => 'required|string',
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
            'other' => $request->oth
            
        ]);

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
            $other = $current_date_row->other;

            $facebook=intval($facebook);
            $instagram=intval($instagram);
            $tiktok=intval($tiktok);
            $other=intval($other);

            $facebook2 = $last_row->facebook;
            $instagram2 = $last_row->instagram;
            $tiktok2 = $last_row->tiktok;
            $other2 = $last_row->other;

            $facebook2=intval($facebook2);
            $instagram2=intval($instagram2);
            $tiktok2=intval($tiktok2);
            $other2=intval($other2);


            $facebook2 = $facebook2+$facebook;
            $instagram2 = $instagram2+$instagram;
            $tiktok2 = $tiktok2+$tiktok;
            $other2 =$other2+$other;



            DB::table('overalls')->where('date', $date)->update(['facebook' => $facebook2]);
            DB::table('overalls')->where('date', $date)->update(['instagram' => $instagram2]);
            DB::table('overalls')->where('date', $date)->update(['tiktok' => $tiktok2]);
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
            


            $last_row_overall = DB::table('overalls')->latest()->first();

            //$rowsCountOverall = $last_row_overall->count();

            if(is_null($last_row_overall)){

                $facebook2 = $last_row->facebook;
                $instagram2 = $last_row->instagram;
                $tiktok2 = $last_row->tiktok;
                $other2 = $last_row->other;
    
                $facebook2=intval($facebook2);
                $instagram2=intval($instagram2);
                $tiktok2=intval($tiktok2);
                $other2=intval($other2);
    

    
    
    
          $overall = new Overall([
    
                'date' => $date,
                'facebook' => $facebook2,
                'instagram' => $instagram2,
                'tiktok' => $tiktok2,
                'other' => $other2
              
                
            ]);
    
            $overall->save();
    
                
          }
        else{

        
            
            $facebook = $last_row_overall->facebook;
            $instagram = $last_row_overall->instagram;
            $tiktok = $last_row_overall->tiktok;
            $other = $last_row_overall->other;

      
            $facebook2 = $last_row->facebook;
            $instagram2 = $last_row->instagram;
            $tiktok2 = $last_row->tiktok;
            $other2 = $last_row->other;

            $facebook2=intval($facebook2);
            $instagram2=intval($instagram2);
            $tiktok2=intval($tiktok2);
            $other2=intval($other2);


            $facebook2 = $facebook2+$facebook;
            $instagram2 = $instagram2+$instagram;
            $tiktok2 = $tiktok2+$tiktok;
            $other2 =$other2+$other;



       
            $overall = new Overall([
    
                'date' => $date,
                'facebook' => $facebook2,
                'instagram' => $instagram2,
                'tiktok' => $tiktok2,
                'other' => $other2
              
                
            ]);
    
            $overall->save();

            
            

        }
        

    }
        return view('/pages/dashboard-analytics', compact('company_id', 'branch_id','time'));

    
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
}
