<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Booking;
use PDF;
use Response;
use Illuminate\Support\Str;

class TransactionsController extends Controller
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
         $user_id = auth()->user()->id;
         $user = User::find($user_id);

         $bins = Booking::where('type','bin')->get();
         $pickups = Booking::where('type', 'pickup')->get();

         $transactions = [
             'bins' => $bins,
             'pickups' => $pickups
         ];

         return view('dashboard.transactions')->with(array('bins' => $bins, 'pickups' => $pickups));
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
        
        return redirect()->route('dashboard.transactions')
                        ->with('success','Booking deleted successfully');
    }

    public function pickupPdf() {
        $pickups = Booking::where('type', 'pickup')->get();
        // return view('dashboard.pdf_view')->with('pickups', $pickups);

        // share data to view
        view()->share('pickups', $pickups);
        $pdf = PDF::loadView('dashboard.pdf_view', $pickups)->setPaper('a4', 'landscape');
        return $pdf->stream();
        // download PDF file with download method
        return $pdf->download('pickup_requests_file.pdf');
    }


    public function pickupCsv() {
        $pickups = Booking::where('type', 'pickup')->get();
        
        $filename = "ucanpickups.csv";
        $handle = fopen($filename, 'w+');
        $i = 1;
        fputcsv($handle, array('#', 'Name', 'Scheme Id', 'Mobile','Address', 'QTY', 'Date', 'Time','Instructions', 'Status'));
        foreach($pickups as $pickup) {
            fputcsv($handle, array(
                $i,
                $pickup->name, 
                $pickup->scheme_id, 
                $pickup->mobile, 
                $pickup->address,
                $pickup->no_of_bins,
                $pickup->expected_date,
                $pickup->expected_time,
                $pickup->instructions,
                $pickup->status
            ));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'ucanpickups.csv', $headers);
    }

    // BIN
    public function binPdf() {
        $bins = Booking::where('type', 'bin')->get();
        // return view('dashboard.pdf_view')->with('pickups', $pickups);

        // share data to view
        view()->share('bins', $bins);
        $pdf = PDF::loadView('dashboard.pdf_view', $bins)->setPaper('a4', 'landscape');
        return $pdf->stream();
        // download PDF file with download method
        return $pdf->download('bin_requests_file.pdf');
    }


    public function binCsv() {
        $bins = Booking::where('type', 'bin')->get();
        
        $filename = "ucanbins.csv";
        $handle = fopen($filename, 'w+');
        $i = 1;
        fputcsv($handle, array('#', 'Name', 'Scheme Id', 'Mobile','Address', 'QTY','Bin Type', 'Instructions', 'Status'));
        foreach($bins as $bin) {
            fputcsv($handle, array(
                $i,
                $bin->name, 
                $bin->scheme_id, 
                $bin->mobile, 
                $bin->address,
                $bin->no_of_bins,
                $bin->bintype,
                $bin->instructions,
                $bin->status
            ));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'ucanbins.csv', $headers);
    }


    public function updateStatus(Request $request)
    {
        
        $id = $request->input('id');

        $booking = Booking::find($id);
        
        $booking->status = $request->input('status');
        $booking->update();

        return redirect()->route('dashboard.transactions')
                         ->with('success','Booking updated successfully');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user_id = auth()->user();
        $user = User::find($user_id);
        $bookings = $user[0]->bookings()->where('type','pickup')->get();
        
        return view('transactions.create')->with(array(
            'user' => $user[0], 
            'bookings' => $bookings)
        );;
    }


    public function store(Request $request){

        //return $request;
        
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'scheme_id' => 'required',
            'address' => 'required',
            'numberofbins' => 'required',
        ]);

        $status = 'pending';
        $uuid = Str::uuid()->toString();
        $expected_date = $request->dateofpickup;
        $expected_time = $request->timeofpickup;
        $bintype = $request->bintype;

        $booking = Booking::create([
            'booking_reference' => $request->type . '_' . $uuid,
            'name' => $request->name,
            'type' => $request->type,
            'expected_date' => $expected_date,
            'expected_time' => $expected_time,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'status' => $status,
            'scheme_id' => $request->scheme_id,
            'instructions' => $request->instructions,
            'user_id' => $request->user_id,
            'no_of_bins' => $request->numberofbins,
            'company' => $request->company,
        ]);
        if($booking) {
            return redirect()->route('dashboard.transactions')->with('success', 'Request Pickup Successful');
        } else {
            return redirect()->route('dashboard.transactions')->with('error', 'Request Pickup Error');
        }

     }
}