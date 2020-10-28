<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
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

    public function index()
    {
        $user_id = auth()->user();
        $user = User::find($user_id);
        return view('dashboard.profile')->with('user', $user[0]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'scheme_id' => 'required',
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

        return redirect()->route('dashboard.profile')
                         ->with('success','User updated successfully');
    }

}
