@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Coupon</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add Coupon</li>
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
  <form class="form-horizontal" method="post" action="{{ url('/admin/coupons/add') }}" novalidate="novalidate" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Coupon Code</label>
              <input type="text" name="coupon_code" id="inputName" class="form-control" value="" >
            </div>
            <div class="form-group">
              <label for="inputDescription">Plan ID</label>
              <select name="plan_id" id="" class="form-control">
                @foreach ($paypal_plans as $plan)
                <option value="{{$plan->plan_id}}">{{$plan->plan_name.' | Disc_Price:'.$plan->first_cycle_price.' | Price:'.$plan->price}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="inputName">Discount Type</label>
              <select name="type" class="form-control">
                <option value="FLATE">FLATE</option>
                <option value="PERCENTAGE">% PERCENTAGE</option>
              </select>
            </div>
            {{-- <div class="form-group">
              <label for="inputName">Frequency</label>
              <select name="frequency" id="" class="form-control" >
                @foreach ($coupons as $freq)
                <option value="{{$freq}}">{{$freq}}</option>
                @endforeach
              </select>
            </div> --}}
            <div class="form-group">
              <label for="inputName">Amount</label>
              <input type="text" name="amount" id="inputName" class="form-control" value="">
            </div>
            <div class="form-group">
              <label for="inputName">Discount Type</label>
              <select name="status" class="form-control">
                <option value="1">ACTIVE</option>
                <option value="0">INACTIVE</option>
              </select>
            </div>
            <div class="form-group">
              <label for="inputName">Expire Date</label>
              <input type="text" name="expiry_date" id="inputName" class="form-control" value="" placeholder="2021-01-31">
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