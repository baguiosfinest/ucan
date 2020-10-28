<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Depot;

class DepotController extends Controller
{

    public function __construct()
     {
         $this->middleware('auth');
     }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $depots = Depot::all();
        return view('dashboard.depots')->with('depots', $depots);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.depots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        //
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        Depot::create($request->all());
        $depots = Depot::all();

        return view('dashboard.depots')
            ->with('depots', $depots)
            ->with('success', 'Depot created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $depot = Depot::find($id);
        $depots = Depot::all();
        if($depot) {
            $depot->delete();
            return redirect()->route('depots')->with('depots', $depots)
                ->with('success', 'Depot deleted successfully');
        } else {
            return redirect()->route('depots')->with('depots', $depots)
                ->with('error', 'Depot not found.');
        }
            
       
    }
}
