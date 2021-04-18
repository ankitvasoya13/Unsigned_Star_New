<style>
    .btn-load{
    display:inline-block;
    width:160px;
    height:45px;
    line-height:45px;
    text-align:center;
    background:transparent;
    color:#111111;
    border:1px solid #e6e6e6;
    cursor: pointer;
    margin-top:50px;
    margin-bottom:40px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    }
    .btn-load:hover{
    background: -moz-linear-gradient(90deg, rgb(248, 71, 62) 20%, rgb(254, 121, 69) 100%);
    background: -webkit-linear-gradient(90deg, rgb(248, 71, 62) 20%, rgb(254, 121, 69) 100%);
    background: linear-gradient(90deg, rgb(248, 71, 62) 20%, rgb(254, 121, 69) 100%);
    color:#fff;
    border:1px solid rgb(248, 71, 62);
    }
</style>
@foreach($artistUsers as $artistUser)
<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <div class="blog_category_box_wrapper blog_box_wrapper2 float_left">
        <div class="blog_news_img_wrapper float_left">
            @if(!empty($artistUser->profile_image))
                <a href="{{url('profile/' . $artistUser->id.'/'.$artistUser->first_name . '-' . $artistUser->last_name)}}"><img src="{{asset('/uploads/' . $artistUser->profile_image)}}" class="img-responsive" alt="img"></a>
            @else
                <a href="{{ url('/profile/'.$artistUser->id.'/'.$artistUser->first_name . '-' . $artistUser->last_name) }}"><img src="{{ asset('images/ft3.jpg') }}" alt="img" class="w-100"></a>
            @endif
        </div>
        <div class="lest_news_cont_wrapper float_left">
            <div class="blog_heaidng_top">
                <h3><a href="{{url('profile/' . $artistUser->id.'/'.$artistUser->first_name . '-' . $artistUser->last_name)}}">{{$artistUser->first_name . ' ' . $artistUser->last_name}}</a></h3>
            </div>
        </div>
    </div>
</div>
@endforeach
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    @if ($total > $limit)
    <button class="btn-load" onclick="searchTopArtist({{$limit}})">Show more results</button>
    @endif    
</div>