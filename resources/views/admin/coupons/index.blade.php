@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Coupons List</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Coupons list</li>
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
        @if(Session::has('success'))
            <div class="alert alert-success alert-block col-md-12">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('success') !!}</strong>
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
                <tr>
                  <th>Coupon Code</th>
                  <th>Plan ID</th>
                  <th>Discount Type</th>
                  <th>Amount</th>
                  <th>Expirire Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($coupons as $coupon)
                    <tr>
                      <td>{{$coupon->coupon_code}}</td>
                      <td>{{$coupon->plan_id}}</td>
                      <td>{{$coupon->type}}</td>
                      <td>{{$coupon->amount}}</td>
                      <td>{{$coupon->expiry_date}}</td>
                      <td>{{($coupon->status) == '1' ? 'ACTIVE':'INACTIVE'}}</td>
                      <td class="center">                        
                        <a href="{{ url('/admin/coupons/edit/'.$coupon->id) }}" class="btn btn-primary btn-mini">Edit</a>
                        <a href="{{ url('/admin/coupons/edit/'.$coupon->id) }}" class="btn btn-danger btn-mini">Delete</a>
                        {{-- <a href="{{ url('/admin/plan/delete/'.$listPlan->plan_id) }}" class="btn btn-danger btn-mini">Delete</a> --}}
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