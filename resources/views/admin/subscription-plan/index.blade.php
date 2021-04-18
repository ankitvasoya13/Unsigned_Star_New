@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Subscription Plan <a href="{{ url('admin/paypal/syncPlan') }}" class="btn btn-primary btn-mini">Refresh Paypal Plan</a></h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Subscription Plan</li>
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
                  <th>Plan ID</th>
                  <th>PayPal Plan</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Trial Price</th>
                  <th>Trial/Disc. Price</th>
                  <th>Track Limit</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if ($listPlans)
                
                  
                @foreach ($listPlans as $listPlan)
                <tr>
                  <td>{{ $listPlan->plan_id }}</td>
                  <td>{{ $listPlan->plan_name }}</td>
                  <td>{{ $listPlan->description }}</td>
                  <td>{{ $listPlan->price }}</td>
                  <td>{{ $listPlan->trial_price }}</td>
                  <td>{{ $listPlan->first_cycle_price }}</td>
                  <td>{{ $listPlan->track_limit }}</td>
                  {{-- <td>{{ $listPlan->type }}</td> --}}
                  <td>{{ $listPlan->status }}</td>
					        <td class="center">
                    {{-- @if ($listPlan->state == 'INACTIVE' || $listPlan->state == 'CREATED')
                      <a href="{{ url('/admin/plan/active/'.$listPlan->plan_id) }}" class="btn btn-success btn-mini">ACTIVE</a> 
                    @else
                      <a href="{{ url('/admin/plan/deactive/'.$listPlan->plan_id) }}" class="btn btn-secondary btn-mini">INACTIVE</a> 
                    @endif --}}
                    <a href="{{ url('/admin/plan/edit/'.$listPlan->plan_id) }}" class="btn btn-primary btn-mini">Edit</a> 
                    <a href="{{ url('/admin/plan/delete/'.$listPlan->plan_id) }}" class="btn btn-danger btn-mini">Delete</a>
                  </td>
                </tr>
                @endforeach
                    
                @else
                  <tr><td colspan="6" style="text-align: center">Data not found</td></tr>    
                @endif
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