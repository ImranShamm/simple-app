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
<form action="{{action('CompaniesController@update',$companies->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="container">
    <div style="padding: 10pt">
      <h2>
        Edit Company
      </h2>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-2">
        <label class="control-label pull-right">Name</label>
      </div>
      <div class="col-lg-9">
        <div class="form-group">
          <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $companies->name }}">
        </div>
      </div>
      <div class="col-lg-2">
        <label class="control-label pull-right">Email</label>
      </div>
      <div class="col-lg-9">
        <div class="form-group">
          <input type="text" class="form-control" id="email" name="email" value="{{ $companies->email }}" type="email">
        </div>
      </div>
      <div class="col-lg-2">
        <label class="control-label pull-right">Website</label>
      </div>
      <div class="col-lg-9">
        <div class="form-group">
          <input type="text" class="form-control" id="website" name="website" value="{{ $companies->website }}">
        </div>
      </div>
      <div class="col-lg-2">
        <label class="control-label pull-right">Upload Logo</label>
      </div>
      <div class="col-lg-9">
        <strong class="pull-left" style="color:red">(Uploaded file must be in PNG) <br> Max dimension = 100x100</strong><br>
      </div>
      <div class="col-lg-2">
      </div>
      <div class="col-lg-9">
        <input type="file" name="logo" id="logo" data-height="100" data-allowed-file-extensions="png PNG JPG jpg"/>
      </div>
    </div>
    <br>
    <div class="row justify-content-center">
      <div class="col-lg-2">
        <br>
      </div>
      <div class="col-lg-9">
        <input type="submit" value="Submit" class="btn btn-primary">
      </div>
    </div>
</div>
</form>
@endsection
