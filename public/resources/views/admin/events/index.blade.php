@extends('admin.layouts.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Pages</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">View Pages</li>
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
                  <th>Event Name</th>
                  <th>Venue</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($events as $event)
                <tr>
                  <td>{{ $event->event_name }}</td>
                  <td>{{ $event->venue }}</td>
                  <td>{{ $event->start_datetime }}</td>
                  <td>{{ $event->end_datetime }}</td>
					        <td class="center"> 
                    <a href="{{ url('/admin/events/edit/'.$event->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                    <a href="{{ url('/admin/events/delete/'.$event->id) }}" class="btn btn-danger btn-mini">Delete</a>
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