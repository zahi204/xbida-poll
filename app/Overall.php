<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Overall extends Model
{

    protected $fillable = ['date','facebook','instagram','tiktok','friend','other'];
    

    public function getCarbonDate(){
        $carbon_date = Carbon::parse($this->date);
        return $carbon_date;
    }

}