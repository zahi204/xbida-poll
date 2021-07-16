<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Overall2 extends Model
{
    protected $fillable = ['date','yes','no'];
    

    public function getCarbonDate(){
        $carbon_date = Carbon::parse($this->date);
        return $carbon_date;
    }
}
