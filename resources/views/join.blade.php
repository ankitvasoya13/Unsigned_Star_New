@extends('layouts.index')

@section('content')

<!--inner Title Start -->
<div class="indx_title_main_wrapper">
    <div class="title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="indx_title_left_wrapper ms_cover">
                    <h2>Join unsignedstar.com</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item">Join</li>
                    </ul>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- inner Title End -->
@include('layouts.join')
<!-- pricing wrapper end -->
@endsection