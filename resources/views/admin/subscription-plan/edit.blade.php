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
  <form class="form-horizontal" method="post" action="{{ url('/admin/plan/edit/'.$localPlan->plan_id) }}" novalidate="novalidate" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Plan ID</label>
              <input type="text" name="plan_id" id="inputName" class="form-control" value="{{ $localPlan->plan_id }}" readonly>
            </div>            
            <div class="form-group">
              <label for="inputName">Subscription Plan Name</label>
              <input type="text" name="name" id="inputName" class="form-control" value="{{ $localPlan->plan_name }}" readonly>
            </div>            
            <div class="form-group">
              <label for="inputDescription">Description</label>              
              <input type="text" name="description" id="" class="form-control" value="{{ $localPlan->description }}" readonly>
            </div>                        
            <div class="form-group">
              <label for="inputName">Frequency</label>
              <input type="text" name="frequency" class="form-control" readonly value="{{$localPlan->frequency}}">
              {{-- <select name="frequency" id="" class="form-control" readonly>
                @foreach ($frequency as $freq)
                  <option value="{{$freq}}" @if ($localPlan->frequency == $freq)
                      {{'selected="selected"'}}
                  @endif>{{$freq}}</option>                  
                  @endforeach                
              </select> --}}
            </div>
            <div class="form-group">
              <label for="inputName">Status</label>
              <input type="text" name="state" class="form-control" value="{{$localPlan->status}}" readonly>
              {{-- <select name="state" id="" class="form-control" readonly>
                @foreach ($states as $state)
                <option value="{{$state}}" @if ($localPlan->state == $state)
                  {{'selected="selected"'}}
                  @endif>{{$state}}</option>
                @endforeach
              </select> --}}
            </div>
            <div class="form-group">
              <label for="inputName">Price $</label>
              <input type="text" name="price" readonly id="inputName" class="form-control" value="{{$localPlan->price}}">
            </div>

            <div class="form-group">
              <label for="inputName">Trial Price $</label>
              <input type="text" name="trial_price" readonly id="inputName" class="form-control" value="{{$localPlan->trial_price}}">
            </div>
            {{-- <div class="form-group">
              <label for="inputName">Trial/Disc. Price $</label>
              <input type="text" name="first_cycle_price" id="inputName" class="form-control"
                value="{{$localPlan->first_cycle_price}}">
            </div> --}}
            <div class="form-group">
              <label for="inputName">No of Track</label>
              <input type="text" name="track_limit" id="inputName" class="form-control" value="{{ $localPlan->track_limit }}">
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