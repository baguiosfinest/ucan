<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Depot;
use App\Booking;

class UsersController extends Controller
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
    public function index(){
        $users = User::all();
        $depots = Depot::all();
        return view('dashboard.users.index')->with(array('users'=> $users, 'depots' => $depots));
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
        $user = User::find($id);
        return view('dashboard.users.show')->with('user', $user);
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
        $user = User::find($request->id);
        $booking = Booking::where('user_id', '=', $request->id);
        $booking->delete();
        $user->delete();
        
        return redirect()->route('user.index')
                        ->with('success','User deleted successfully');
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
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $id = $request->input('user_id');

        $user = User::find($id);
        $user->scheme_id = $request->input('scheme_id');
        $user->aboutme = $request->input('aboutme');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->address = $request->input('address');
        $user->update();

        return redirect()->route('user.index')
                         ->with('success','Cleint updated successfully');
     }

}
