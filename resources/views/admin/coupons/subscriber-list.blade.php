@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Subscriber list</h1>
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
                <tr>
                  <th>Subscriber Name(Artist)</th>
                  <th>Email</th>
                  <th>Plan Name</th>
                  <th>Plan Price</th>
                  <th>Next Payment Date</th>                  
                  <th>Status</th>                  
                </tr>
                </thead>
                <tbody>
                @if ($listSubscribers)
                
                  
                @foreach ($listSubscribers as $subscriber)
                <tr>
                  <td>{{ $subscriber->first_name.' '.$subscriber->last_name }}</td>
                  <td>{{ $subscriber->email }}</td>					        
                  <td>{{ $subscriber->plan_name }}</td>
                  <td>{{ $subscriber->last_payment_amount }}</td>
                  <td>{{ $subscriber->end_validity }}</td>
                  <td>{{ $subscriber->agreement_state }}</td>
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