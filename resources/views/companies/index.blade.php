@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="card-body text-left">
      <h2>
        List of Companies
      </h2>
    </div>
    <div class="card-body text-right">
      <a href="{{ URL::to('companies/create') }}" class="btn btn-w-m btn-primary text-center"><i class="fas fa-sign-in-alt"></i>Create New</a href="">
    </div>
  </div>
  <table class="table table-bordered mb-5">
      <thead>
          <tr class="table-success">
              <th scope="col">No.</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Website</th>
              <th scope="col" style="width: 10%"></th>
          </tr>
      </thead>
      <tbody>
          @foreach($companies as $key => $data)
          <tr>
              <th scope="row">{{ $key+1 }}</th>
              <td>{{ $data->name }}</td>
              <td>{{ $data->email }}</td>
              <td>{{ $data->website }}</td>
              <td>
                <a href="companies/{{$data->id}}/edit" class="btn btn-w-m btn-primary text-center" style="border-color: #ffffff00;" data-toggle="tooltip" data-original-title="Edit" title="Edit">
                  <i class="fa fa-edit"></i></a>
                <a href="companies/{{$data->id}}/destroy" id="delete" class="btn btn-w-m btn-danger text-center" style="border-color: #ffffff00;"  data-toggle="tooltip" data-original-title="Delete" title="Delete">
                  <i class="fa fa-trash"></i></a>
              </td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
<div class="d-flex justify-content-center">
  {!! $companies->links() !!}
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(".alert").show(() => {
    setTimeout(() => {
        $(".alert").fadeTo(500, 1).slideUp(500, () => {
        })
    }, 4000)
  });
</script>
<script>
  $('#delete').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      })
      .then((willDelete) => {
      if (willDelete) {
          event.preventDefault();
          window.location.href = url;
      }
    });
});
@if(session('success'))
  swal("Deletion Success", "{{ session('success') }}","success");
@endif

@if(session('status'))
  swal("Success", "{{ session('status') }}","success");
@endif
</script>

@endpush
