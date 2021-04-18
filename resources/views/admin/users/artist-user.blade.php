@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Artists</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">View Users</li>
        </ol>
      </div>
    </div>
    <div class="row">
      @if(Session::has('flash_message_error'))
      <div class="alert alert-error alert-block col-md-12">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! session('flash_message_error') !!}</strong>
      </div>
      @endif
      @if(Session::has('flash_message_success'))
      <div class="alert alert-success alert-block col-md-12">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{!! session('flash_message_success') !!}</strong>
      </div>
      @endif
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>              
              <a href="/admin/downloadCSV/1" class="btn btn-info btn-mini" style="float: right">Download in Excel</a>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Featured</th>
                <th>Home Featured</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{ $user->first_name.' '.$user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td class="center">
                  <a href="{{ url('/admin/artists/featured/'.$user->id) }}">
                    @if($user->featured == 0)
                    <i class="far fa-star"></i>
                    @else
                    <i class="fas fa-star"></i>
                    @endif
                  </a>
                </td>
                <td class="center">
                  <a href="{{ url('/admin/artists/homefeatured/'.$user->id) }}">
                    @if($user->homefeatured == 0)
                    <i class="far fa-star"></i>
                    @else
                    <i class="fas fa-star"></i>
                    @endif
                  </a>
                </td>
                <td class="center">
                  <a href="{{ url('/admin/artists/status/'.$user->id) }}" class="btn btn-info btn-mini">@if($user->status == '0') Approve @else Unapprove @endif</a>
                  <!-- <a href="{{ url('/admin/users/edit/'.$user->id) }}" class="btn btn-primary btn-mini">Edit</a> -->
                  <a href="{{ url('/admin/artists/delete/'.$user->id) }}" class="btn btn-danger btn-mini">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection