<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    protected $fillable = ['branch_id','company_id','facebook','instagram','tiktok','other'];
    

}