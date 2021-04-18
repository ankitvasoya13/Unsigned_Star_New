@extends('layouts.index')

@section('content')
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
	<div class="title_img_overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="indx_title_left_wrapper ms_cover">
					<h2>Competitions</h2>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item">Competitions</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- inner Title End -->
<!-- competition list wrapper start-->
<div class="blog_category_wrapper ms_cover">
	<div class="container">
		<div class="row text-center" id="result"> 
             
        </div>
			{{-- {{ $competitions->links("pagination::bootstrap-4") }} --}}
	</div>
</div>
@endsection
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>
    
    $(document).ready(function(){
	competitionsLoad(8);
	});
    function competitionsLoad(limit = null) {
    $.ajax({
        type: "GET",
        url: "competitionsLoadAjax",
        data: { limit:limit },
        success: function(data) {
            $("#result").html(data);
        },
        });
    }
</script>