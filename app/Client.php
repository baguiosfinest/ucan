<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'name', 'email','scheme_id', 'mobile' , 'address', 'lat', 'lng', 'postcode', 'suburb', 'state'
    ];
}