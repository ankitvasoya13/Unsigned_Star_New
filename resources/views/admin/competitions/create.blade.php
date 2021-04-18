@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Competition</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Competition</li>
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
  <form class="form-horizontal" method="post" action="{{ url('/admin/competitions/add') }}" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Competition Name</label>
              <input type="text" name="competition_name" id="inputName" class="form-control" required="" />
            </div>
              <div class="form-group">
                  <label for="inputName">Short Description</label>
                  <input type="textarea" name="short_description" id="short_description" class="form-control" required="" />
                </div>
            <div class="form-group">
              <label for="inputDescription">Description</label>
              <textarea class="textarea" name="description"></textarea>
            </div>
            <div class="form-group">
              <label for="inputName">Venue</label>
              <input type="text" name="venue" id="inputName" class="form-control" value="" required="" />
            </div>
            <div class="form-group">
              <label for="customFile">Featured Image</label>
              <div class="custom-file">
                {{--<input type="file" name="featured_image" class="custom-file-input" id="customFile" required="" />
                <label class="custom-file-label" for="customFile">Choose file</label>--}}
                  <input type="hidden" name="featured_image" id="eventInputImage" value="">
                  <span class="orangeBtn modalOpen" data-toggle="modal" data-target="#ImageCropper_modal" data-type="eventImage">Upload Image</span>
              </div>
                <div id="uploaded_image" style="padding-top: 20px;">
                <p><img id="competition_create_image_preview" class="featured_image_preview" src="{{ asset('/images/blank.jpg') }}" alt="preview image"></p>
                    </div>
              <small>Image must be 540 x 540 pixel and format must be .jpg.</small>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Start Date</label>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>

                  <input type="datetime-local" class="form-control require" name="start_datetime" required="" placeholder="Start Date *" />

                  <!-- <input type="text" name="start_datetime" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" required="" />-->
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group col-md-6">
                <label>End Date</label>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>

                  <input type="datetime-local" class="form-control require" name="end_datetime" required="" placeholder="End Date *" />

                  <!--<input type="text" name="end_datetime" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" required="" />-->
                </div>
                <!-- /.input group -->
              </div>
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
        <input type="submit" value="Publish" class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
@endsection
{{--
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#customFile').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#competition_create_image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });

</script>--}}
@include('admin.layouts.ImageCropperJs')
