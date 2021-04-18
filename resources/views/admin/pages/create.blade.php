@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Page</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Page</li>
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
  <form class="form-horizontal" method="post" action="{{ url('/admin/pages/add') }}" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Page Title</label>
              <input type="text" name="title" id="inputName" class="form-control" value="" required="">
            </div>
            <div class="form-group">
              <label for="inputDescription">Page Content</label>
              <textarea class="textarea" name="content" required=""></textarea>
            </div>
            <div class="form-group">
              <label for="inputName">Featured Image</label>
                <div class="custom-file">

                    {{--<label class="custom-file-label" for="customFile">Choose file</label>
                  <input type="file" name="featured_image" class="custom-file-input" id="customFile" required="">--}}
                    <input type="hidden" name="featured_image" id="eventInputImage" value="">
                    <span class="orangeBtn modalOpen" data-toggle="modal" data-target="#ImageCropper_modal_cms_page" data-type="eventImage">Upload Image</span>
                </div>

                <div id="uploaded_image" style="padding-top: 20px;">
                    <p>
                        <img id="featured_image_preview" src="{{ asset('/images/blank.jpg') }}" alt="preview image"
                  style="max-width: 350px;">
                    </p>
                </div>
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
              <input type="text" name="meta_title" id="inputName" class="form-control" value="">
            </div>
            <div class="form-group">
              <label for="inputSpentBudget">Meta Description</label>
              <textarea id="inputDescription" name="meta_description" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
              <label for="inputEstimatedBudget">Meta URL</label>
              <input type="text" name="meta_url" id="inputName" class="form-control" value="">
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
      $('#featured_image').change(function(){      
      let reader = new FileReader();
      reader.onload = (e) => { 
        $('#featured_image_preview').attr('src', e.target.result); 
      }
      reader.readAsDataURL(this.files[0]);   
    });
  });
  $(document).on('click','#PhotoTab',function() {
//   $('#profileImage').click(function(event){
      console.log("yes yes")
      $image_crop.croppie('result', {
          type:'canvas',
          size:'viewport'
      }).then(function(response){
          var _token = $('input[name=_token]').val();
          var id = $('input[name=id]').val();
          $.ajax({
              url:'{{ route("image_crop.photoUpload") }}',
              type:'post',
              data:{"image":response, _token:_token, id:id},
              dataType:"json",
              success:function(data)
              {
                  //   var crop_image = '<img src="'+data.path+'" />';
                  // //   $('#image_preview').html(crop_image);
                  $("#image_preview").load(location.href + " #image_preview");
                  $("#ImageCropper_modal").modal('hide');
              }
          });
      });
  });
</script>--}}
@include('admin.layouts.ImageCropperJs')