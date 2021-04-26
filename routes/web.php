<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route url
//Route::get('/', 'DashboardController@dashboardAnalytics');

use App\Overall;

Route::get('/all-as-csv', function(){

    $table = Overall::all();
    $filename = "poll.csv";
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('date', 'facebook', 'instagram', 'tiktok',
        'other'));

    foreach($table as $row) {
        fputcsv($handle, array($row['date'], $row['facebook'], $row['instagram']
        , $row['tiktok'] , $row['other']));
    }

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

    return Response::download($filename, 'poll.csv', $headers);

})->name('getCSV');

Route::get('/', 'AuthenticationController@login');

// Route Dashboards
Route::get('/dashboard-analytics', 'DashboardController@dashboardAnalytics');
Route::get('/dash-analysis', 'DashboardController@dashboardAnalysis');
Route::get('/thanks-page', 'DashboardController@thanks');

// Route Authentication Pages
Route::get('/auth-login', 'AuthenticationController@login');
Route::get('/auth-register', 'AuthenticationController@register');
Route::get('/auth-forgot-password', 'AuthenticationController@forgot_password');
Route::get('/auth-reset-password', 'AuthenticationController@reset_password');
Route::get('/auth-lock-screen', 'AuthenticationController@lock_screen');

Auth::routes();

Route::post('/login/validate', 'Auth\LoginController@validate_api');
Route::post('/inRangeData', 'DashboardController@getDataInRange')->name('analytics.by.range');

