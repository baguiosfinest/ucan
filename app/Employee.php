<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = 'employee';

    protected $fillable = [
        'name',
        'email',
        'job_title',
        'dob',
        'address',
        'mobile',
        'tfn',
        'superfund',
        'supernumber',
        'depot',
        'emergency',
        'emergency_contact',
        'employment_status'
    ];
}