@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Slider</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Edit Slider</li>
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
  <form class="form-horizontal" method="post" action="{{ url('/admin/sliders/edit/'.$sliderDetails->id) }}" novalidate="novalidate" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">

          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Main Heading</label>
              <input type="text" name="heading_1" id="inputName" class="form-control" value="{{ $sliderDetails->heading_1 }}">
            </div>
            <div class="form-group">
              <label for="inputName">Sub Heading</label>
              <input type="text" name="heading_2" id="inputName" class="form-control" value="{{ $sliderDetails->heading_2 }}">
            </div>
            <div class="form-group">
              <label for="inputDescription">Description</label>
              <textarea class="textarea" name="description">{{ $sliderDetails->description }}</textarea>
            </div>
            <div class="form-group">
              <label for="customFile">Slider Image</label>
              <div class="custom-file">
                <input type="file" name="slider_image" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
            </div>
            <div class="form-group">
              <label for="inputName">Button URL</label>
              <input type="text" name="button_url" id="inputName" class="form-control" value="{{ $sliderDetails->button_url }}">
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