@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Page</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Edit Page</li>
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
  <form class="form-horizontal" method="post" action="{{ url('/admin/packages/edit/'.$packageDetails->id) }}" novalidate="novalidate" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Package Name</label>
              <input type="text" name="title" id="inputName" class="form-control" value="{{ $packageDetails->title }}">
            </div>
            <div class="form-group">
              <label for="inputDescription">Description</label>
              <textarea class="textarea" name="description">{{ $packageDetails->description }}</textarea>
            </div>
            <div class="form-group">
              <label for="inputName">Price</label>
              <input type="text" name="price" id="inputName" class="form-control" value="{{ $packageDetails->price }}">
            </div>
            <div class="form-group">
              <label for="inputName">No of Track</label>
              <input type="text" name="track_limit" id="inputName" class="form-control" value="{{ $packageDetails->track_limit }}">
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
        <input type="submit" value="Update" class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
@endsection