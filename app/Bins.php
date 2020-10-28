<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bins extends Model
{
    //
    protected $table = 'bins';
    public $primaryKey = 'id';

    protected $fillable = [
        'total',
        'twotwo',
        'oneone',
        'user_id',
        'company',
        'dropoff-date',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}