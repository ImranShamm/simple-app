@extends('layouts.app')

@section('content')
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<form action="{{action('EmployeesController@update',$employees->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="container">
  <div style="padding: 10pt">
    <h2>
      Create New Employee
    </h2>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-2">
      <label class="control-label pull-right">First Name</label>
    </div>
    <div class="col-lg-9">
      <div class="form-group">
        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employees->first_name }}">
      </div>
    </div>
    <div class="col-lg-2">
      <label class="control-label pull-right">Last Name</label>
    </div>
    <div class="col-lg-9">
      <div class="form-group">
        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employees->last_name }}">
      </div>
    </div>
    <div class="col-lg-2">
      <label class="control-label pull-right">Company</label>
    </div>
    <div class="col-lg-9">
      <div class="form-group">
        <select class="form-select" name="company" style="padding: 5pt;width:100%" aria-label="Default select example">
          <option value="{{ $employees->company ? $employees->company : "" }}">{{ $employees->company ? $employees->companies->name : "Select One" }}</option>
          @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-lg-2">
      <label class="control-label pull-right">Email</label>
    </div>
    <div class="col-lg-9">
      <div class="form-group">
        <input type="text" class="form-control" id="email" name="email" value="{{ $employees->email }}" type="email">
      </div>
    </div>
    <div class="col-lg-2">
      <label class="control-label pull-right">Phone</label>
    </div>
    <div class="col-lg-9">
      <div class="form-group">
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $employees->phone }}">
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-2">
      <br>
    </div>
    <div class="col-lg-9">
      <input type="submit" value="Submit" class="btn btn-primary">
    </div>
  </div>
</form>
@endsection
