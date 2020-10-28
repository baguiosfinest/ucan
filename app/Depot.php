<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    //

    protected $table = 'depot';

    protected $fillable = [
        'name',
        'phonenumber',
        'address',
        'suburb',
        'state',
        'postcode',
        'latitude',
        'longtitude',
        'country'
    ];
}
