<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class resident extends Model
{
    protected $table = 'tbl_residents'; 
    public $timestamps = true;
    const UPDATED_AT = null;
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'profile_image',
        'house_no',
        'street',
        'area_no',
        'barangay',
        'city',
        'date_of_birth',
        'gender',
        'civil_no',
        'contact_no',
        'religion_no',
        'citizenship',
        'voter_status',
        'precinct_no',
        'occupation',
        'employment_status',
        'special_group_no',
        'verify_image',
        'username',
        'password',
        'status',
    ];
}
