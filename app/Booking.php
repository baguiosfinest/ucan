<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Table Name
    protected $table = 'bookings';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'booking_reference',
        'name',
        'type',
        'no_of_bins',
        'expected_date',
        'expected_time',
        'address',
        'mobile',
        'status',
        'scheme_id',
        'instructions',
        'user_id',
        'bintype',
        'company'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}