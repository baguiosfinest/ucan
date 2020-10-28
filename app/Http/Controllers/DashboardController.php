<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Depot;
use App\Booking;
use App\Client;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

    //
    public function index()
    {
        $user = auth()->user();
        $users = User::all();
        $clients = Client::all();
        $bin_count = $user->bookings()->where('type','bin')->count();
        $pickup_count = $user->bookings()->where('type', 'pickup')->count();
        $allbin_count = Booking::where('type','bin')->count();
        $allpickup_count = Booking::where('type', 'pickup')->count();
        $user->bincount = $bin_count;
        $user->pickupcount = $pickup_count;
        $users->allbin_count = $allbin_count;
        $users->allpickup_count = $allpickup_count;

        $totalbins = DB::table('bins')
            ->sum(\DB::raw('oneone + twotwo'));

        $depots = Depot::all();
        return view('dashboard.index')->with(array('user' => $user, 'users' => $users, 'depots' => $depots, 'clients' => $clients, 'totalbins' => $totalbins ));
    }
}