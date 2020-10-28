<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use App\Booking;


class RequestBinController extends Controller
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
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
     {
        $user_id = auth()->user();
        $user = User::find($user_id);
        $bookings = $user[0]->bookings()->where('type','bin')->get();
        return view('dashboard.request-a-bin')
            ->with(array(
                'user' => $user[0], 
                'bookings' => $bookings)
        );
     }

     public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'scheme_id' => 'required',
            'address' => 'required',
        ]);

        $status = 'pending';
        $uuid = Str::uuid()->toString();
        $expected_date = $request->expected_date;
        $expected_time = $request->expected_time;
        
        // return $request->bintype;

        $booking = Booking::create([
            'booking_reference' => $request->type . '_' . $uuid,
            'name' => $request->name,
            'type' => $request->type,
            'no_of_bins' => $request->numberofbins,
            'expected_date' => $expected_date,
            'expected_time' => $expected_time,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'status' => $status,
            'scheme_id' => $request->scheme_id,
            'instructions' => $request->instructions,
            'user_id' => $request->user_id,
            'bintype' => $request->bintype
        ]);

        if($booking) {
            return redirect()->route('request-a-bin')->with('success', 'Bin Request Successful!');
        } else {
            return redirect()->route('request-a-bin')->with('error', 'Bin Request Error');
        }
        
     }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request)
    {
        //
        $booking = Booking::find($request->id);
        $booking->delete();
        
        return redirect()->route('request-a-bin')
                        ->with('success','Booking deleted successfully');
    }
}
