<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Depot;
use App\Booking;
use App\Bins;
use PDF;
use Spatie\Geocoder\Facades\Geocoder;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    //
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
    public function index(){
        $clients = Client::paginate(10);
        $depots = Depot::all();
        return view('dashboard.clients.index')->with(array('clients'=> $clients, 'depots' => $depots));
    }

     //
     public function sort(){
        $clients = DB::table('clients')->orderBy('suburb','asc')->get();
        $depots = Depot::all();
        

        foreach($clients as $client) {
            $postcodes[$client->postcode][] = $client;
        }
        
        return view('dashboard.clients.index')->with(array('clients'=> $postcodes, 'depots' => $depots, 'sort' => true));
    }


    public function get_sorted_pdf(){
        $clients = DB::table('clients')->orderBy('suburb','asc')->get();
        $clientsNew = new \stdClass();

        foreach($clients as $client) {
            $binArr = Bins::where('user_id', '=', $client->id)->get();
            $client->bins = $binArr[0];
        }

        foreach($clients as $client) {
            $postcodes[$client->postcode][] = $client;
        }

        //return view('dashboard.clients.pdf_view')->with('clients', $postcodes);

        view()->share('clients', $postcodes);
        $pdf = PDF::loadView('dashboard.clients.pdf_view', $postcodes)->setPaper('a4', 'landscape');
        return $pdf->stream();
        // download PDF file with download method
        // return $pdf->download('clients_sorted_file.pdf');
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
        $client = Client::find($id);
        $binArr = Bins::where('user_id', '=', $id)->get();
        $bintwo = 0;
        $binone = 0;
        $bin = array();
        $len = 0;
        $bin['dropoff_date'] = '';
        $bin['company'] = '';
        
        if(count($binArr) > 0){
            $len = count($binArr) - 1;
            $bin['dropoff_date'] = $binArr[$len]['dropoff_date'];
            $bin['company'] = $binArr[$len]['company'];
            foreach ($binArr as $key => $subArray) {
                $binone += $subArray->oneone;
                $bintwo += $subArray->twotwo;
            }
        } else {
            $bin['twotwo'] = 0;
            $bin['oneone'] = 0;
            $bin['total'] = 0;
        }
       
        $bin['twotwo'] = $bintwo;
        $bin['oneone'] = $binone;
        $bin['total'] = $binone + $bintwo;

        // return $bin;
        
        return view('dashboard.clients.show')->with(array('client'=> $client, 'bin' => $bin));
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
        $client = Client::find($request->id);
        $bin = Bins::where('user_id', '=', $request->id);
        $bin->delete();
        $client->delete();
        
        return redirect()->route('client.index')
                        ->with('success','Client deleted successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
     {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'scheme_id' => 'required',
            'address' => 'required',
            'email' => 'required',
        ],[
            'name.required' => 'Name is required.',
            'mobile.required' => 'Mobile Number is required.',
            'scheme_id.required' => 'Scheme ID is required.',
            'address.required' => 'Address is required.',
            'email.required' => 'Email Address is required.',
        ]);

        $complete_address = $request->address . ", " . $request->suburb . ", Australia " . $request->postcode; 
        $client = new \GuzzleHttp\Client(['verify' => false ]);
        $geocoder = new \Spatie\Geocoder\Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));
        $geocoder->setCountry(config('geocoder.country'));
        $result = $geocoder->getCoordinatesForAddress($complete_address);

        $id = $request->input('client_id');
        
        $client = Client::find($id);
            
        $client->scheme_id = $request->input('scheme_id');
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->mobile = $request->input('mobile');
        $client->address = $request->input('address');
        $client->state = $request->input('state');
        $client->suburb = $request->input('suburb');
        $client->postcode = $request->input('postcode');
        $client->lat = $result["lat"];
        $client->lng = $result["lng"];
        $client->update();
        if (!isset($args)) {
            $args = new \stdClass();
        }

        $args->oneone = $request->input('oneone');
        $args->twotwo = $request->input('twotwo');
        $args->company = $request->input('company');
        $args->dropoff_date = $request->input('dropoff_date');
        $this->updatebin($id,$args);

        return redirect()->back()
                         ->with('success','Client updated successfully');
     }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.clients.create');
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'scheme_id' => 'required',
            'address' => 'required',
            'email' => 'required',
        ],[
            'name.required' => 'Name is required.',
            'mobile.required' => 'Mobile Number is required.',
            'scheme_id.required' => 'Scheme ID is required.',
            'address.required' => 'Address is required.',
            'email.required' => 'Email Address is required.',
        ]);

        $complete_address = $request->address . ", " . $request->suburb . ", Australia " . $request->postcode; 
        $client = new \GuzzleHttp\Client(['verify' => false ]);
        $geocoder = new \Spatie\Geocoder\Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));
        $geocoder->setCountry(config('geocoder.country'));
        $result = $geocoder->getCoordinatesForAddress($complete_address);

        $clientMain = Client::create([
            'name' => $request->name,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'scheme_id' => $request->scheme_id,
            'email' => $request->email,
            'lat' => $result["lat"],
            'lng' => $result["lng"],
            'state' => $request->state,
            'postcode' => $request->postcode,
            'suburb' => $request->suburb,
        ]);

        $this->addbinManually($clientMain->id);

        return redirect()->route('client.show', ['id' => $clientMain->id])
                         ->with('success','Client created');
     }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function addbin(Request $request)
     {
        $bin = Bins::where('user_id', $request->id)->get();
        $bin = $bin[0];
        $bin->twotwo = $request->twotwo;
        $bin->oneone = $request->oneone;
        $bin->company = $request->company;
        $bin->dropoff_date = $request->dropoff_date;
        $bin->update();
        return redirect()->back()
                         ->with('success','Client bin Added');
     }

    public function addbinManually($id)
    {
       $bins = Bins::create([
           'user_id' => $id,
           'twotwo' => 0,
           'oneone' => 0,
           'company' => '',
       ]);
    }

     public function updatebin($id, $args)
     {

        $bin = Bins::where('user_id', $id)->get();
        $bin = $bin[0];
        $bin->twotwo = $args->twotwo;
        $bin->oneone = $args->oneone;
        $bin->company = $args->company;
        $bin->dropoff_date = $args->dropoff_date;
        $bin->update();
        return redirect()->back()
                         ->with('success','Client bin updated');
     }



     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function map(Request $request)
     {
        $clients = Client::all();
        if(!$clients->isEmpty()) {
            return view('dashboard.clients.map')->with('clients', $clients);
        } else {
            return view('dashboard.404')->with('message', 'Clients not found. Kindly add clients in the Clients page.');
        }
       
     }

     public function bookpickup(Request $request) {

        $client = Client::find($request->id);
        $client->forpickup = !$client->forpickup;
        $client->update();

        if($client->forpickup) {
            return redirect()->back()
                             ->with('success','Client booked for pick up.');
        } else {
            return redirect()->back()
                             ->with('success','Client removed for pick up.');
        }
     }


     public function booked(Request $request) {
        $clients = DB::table('clients')
                    ->where('forpickup', 1)
                    ->get();
        return view('dashboard.clients.booked')->with('clients', $clients);

     }

     public function resetbooking(Request $request) {
        return redirect()->route('client.index')
                    ->with('success', 'Pickup has been reset.');
     }

}