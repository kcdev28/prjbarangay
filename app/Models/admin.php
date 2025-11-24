<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table = 'vw_admins';     
    protected $primaryKey = 'userID';    
    
    public $timestamps = false; 
    public $incrementing = false;

    protected $guarded = [];           
}
