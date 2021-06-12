<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Employees;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $employees = Employees::orderBy('created_at', 'desc')->paginate(10);
      $users = auth()->user()->name;

      return view('employees.index',
          ['employees' => $employees],
          ['users' => $users]
      );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $users = auth()->user()->name;
      $companies = Companies::all();
      return view('employees.create',
       ['users' => $users],
       ['companies' => $companies]
      );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'first_name' => 'required',
        'last_name' => 'required',
      ]);

      $add = new Employees;
      $add->id = Uuid::uuid4()->getHex();
      $add->first_name = $request->first_name;
      $add->last_name = $request->last_name;
      $add->company = $request->company;
      $add->email = $request->email;
      $add->phone = $request->phone;
      $add->save();

      return redirect('employees')->with('status','Employee has been added');
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
      $employees = Employees::find($id);
      $companies = Companies::all();

        return view('employees.edit',
        ['employees' => $employees],
        ['companies' => $companies]
      );
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
       $employees = Employees::find($id);

       $employees->first_name =  $request->first_name;
       $employees->last_name =  $request->last_name;
       $employees->company =  $request->company;
       $employees->email =  $request->email;
       $employees->phone =  $request->phone;
       $employees->save();
       
       return redirect('employees')->with('status','Employee successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $employees = Employees::find($id);
      $employees->delete();
      return back()->with('success','Employees deleted successfully');
    }
}
