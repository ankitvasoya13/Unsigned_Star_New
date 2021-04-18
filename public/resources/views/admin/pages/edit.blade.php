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
  <form class="form-horizontal" method="post" action="{{ url('/admin/pages/edit/'.$pageDetails->id) }}" novalidate="novalidate" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Page Title</label>
              <input type="text" name="title" id="inputName" class="form-control" value="{{ $pageDetails->title }}">
            </div>
            <div class="form-group">
              <label for="inputDescription">Page Content</label>
              <textarea class="textarea" name="content">{{ $pageDetails->content }}</textarea>
            </div>
            <div class="form-group">
              <label for="inputName">Featured Image</label>
              <input type="hidden" name="featured_image_upload" value="{{ $pageDetails->featured_image }}">
              <input type="file" name="featured_image" id="inputName" class="form-control">
              <small>Image must be 350 x 350 pixel and format must be .jpg.</small>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-12" style="display: none;">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">SEO Details</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputEstimatedBudget">Meta Title</label>
              <input type="text" name="meta_title" id="inputName" class="form-control" value="{{ $pageDetails->meta_title }}">
            </div>
            <div class="form-group">
              <label for="inputSpentBudget">Meta Description</label>
              <textarea id="inputDescription" name="meta_description" class="form-control" rows="4">{{ $pageDetails->meta_description }}</textarea>
            </div>
            <div class="form-group">
              <label for="inputEstimatedBudget">Meta URL</label>
              <input type="text" name="meta_url" id="inputName" class="form-control" value="{{ $pageDetails->meta_url }}">
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