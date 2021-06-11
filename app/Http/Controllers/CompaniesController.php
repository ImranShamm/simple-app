<?php

namespace App\Http\Controllers;

use App\Companies;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //sort by created_at
      $companies = Companies::orderBy('created_at', 'desc')->paginate(10);
      $users = auth()->user()->name;

      return view('companies.index',
          ['companies' => $companies],
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

      return view('companies.create',
       ['users' => $users]
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
        'company_name' => 'required',
        'logo' => 'dimensions:max_width=100,max_height=100'
      ]);

      $add = new Companies;
      $add->id = Uuid::uuid4()->getHex();;
      $add->name = $request->company_name;
      $add->email = $request->email;
      $add->website = $request->website;

      //Handle if there is any picture uploaded, and saved in the storage
      if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $path = $file->store('file/Company', 'public');
        $add->logo = $path;
      }
      $add->save();
      return redirect('companies')->with('status','Company has been added');
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
      $companies = Companies::find($id);
      
      return view('companies.edit',
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
      $companies = Companies::find($id);
      $companies->name = $request->company_name;
      $companies->email = $request->email;
      $companies->website = $request->website;
      if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $path = $file->store('file/Company', 'public');
        $companies->logo = $path;
      }
       $companies->save();
       return redirect('companies')->with('status','Company successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $companies = Companies::find($id);
      $companies->delete();
      return back()->with('success','Companies deleted successfully');
    }
}
