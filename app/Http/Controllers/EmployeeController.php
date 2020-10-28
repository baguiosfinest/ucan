<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    
     public function __construct()
     {
         $this->middleware('auth');
     }

    //
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('dashboard.employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.employees.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'email' => 'required',
            'tfn' => 'required',
            'superfund' => 'required',
            'supernumber' => 'required',
        ],[
            'name.required' => 'Name is required.',
            'mobile.required' => 'Mobile Number is required.',
            'address.required' => 'Address is required.',
            'email.required' => 'Email Address is required.',
            'tfn.required' => 'TFN is required.',
            'superfund.required' => 'Superfund is required.',
            'supernumber.required' => 'Superfund Membership number is required.',
            ]);

        if (Employee::where('email', $request->email)->exists()) {
            return redirect()->route('employee.index')
                         ->with('error','Employee already exist');
        } else {
            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'job_title' => $request->job_title,
                'dob' => $request->dob,
                'address' => $request->address,
                'mobile' => $request->mobile,
                'tfn' => $request->tfn,
                'superfund' => $request->superfund,
                'supernumber' => $request->supernumber,
                'depot' => $request->depot,
                'emergency' => $request->emergency,
                'emergency_contact' => $request->emergency_contact,
                'employment_status' => $request->employment_status,
            ]);

            return redirect()->route('employee.index')
                         ->with('success','New Employee Created');
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
        $employee = Employee::find($request->id);
        $employee->delete();
        
        return redirect()->route('employee.index')
                        ->with('success','Employee deleted successfully');
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $employee = Employee::find($id);
       return view('dashboard.employees.show')->with('employee', $employee);
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
       
       $id = $request->input('employee_id');

       $employee = Employee::find($id);

       $employee->name = $request->input('name');
       $employee->email = $request->input('email');
       $employee->job_title = $request->input('job_title');
       $employee->dob = $request->input('dob');
       $employee->address = $request->input('address');
       $employee->mobile = $request->input('mobile');
       $employee->tfn = $request->input('tfn');
       $employee->superfund = $request->input('superfund');
       $employee->supernumber = $request->input('supernumber');
       $employee->depot = $request->input('depot');
       $employee->emergency = $request->input('emergency');
       $employee->emergency_contact = $request->input('emergency_contact');
       $employee->employment_status = $request->input('employment_status');
       $employee->update();

       return redirect()->back()
                        ->with('success','Employee updated successfully');
    }


}