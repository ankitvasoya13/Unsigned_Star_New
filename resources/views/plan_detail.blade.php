@extends('layouts.index')

@section('content')
<!--inner Title Start -->
<div class="indx_title_main_wrapper">
    <div class="title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="indx_title_left_wrapper ms_cover">
                    <h2>Subscribe</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item">Subscribe</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- inner Title End -->
<!-- top artist wrapper start -->
<div class="contact_section treanding_songs_wrapper ms_cover">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                @if(Session::has('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {!! session('error') !!}
                </div>
                @endif
                @if(Session::has('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {!! session('success') !!}
                </div>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-7 col-sm-12" style="margin-bottom: 10px;">
                <div class="ms_heading_wrapper artist_dashboard">
                    <h1>Plan Details</h1>
                </div><br clear="all" />
                @if ($userDetails->user_type == 1)

                <div class="card text-center">
                    <div class="card-header">
                        <span class="float-left">Profile :
                            @if ($userDetails->remainingDays > 0)
                            <span class="text-success">Active</span>
                            @else
                            <span class="text-danger">Inactive</span>
                            @endif
                        </span>
                        @if($userDetails->end_validity)
                        <span class="float-right">Plan expire : {{date('m/d/Y', strtotime($userDetails->end_validity))}}
                        <span class="text-danger">( {{ ($userDetails->remainingDays < 0)? '0': $userDetails->remainingDays}} days remaining)</span> </span>
                        @endif
                        <input type="hidden" name="user_id" value="{{$userDetails->id}}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$planDetails->plan_name}}</h5>
                        {{-- <p class="card-text">{{$planDetails->description}}</p> --}}
                        <p class="card-text">Track Limit : {{$planDetails->track_limit}}</p>
                        <p class="card-text">Validity : {{$planDetails->frequency}} (auto-renewal)</p>
                        @if($planDetails->is_trial == 1)
                            <p class="card-text">Trail Price : ${{$planDetails->trial_price}}/{{$planDetails->frequency}}</p>
                            <p class="card-text">Regular Price : ${{$planDetails->price}}/{{$planDetails->frequency}}</p>
                        @else
                            <p class="card-text">Regular Price : ${{$planDetails->price}}/{{$planDetails->frequency}}</p>
                        @endif
                        <input type="hidden" name="plan_id" id="plan_id" value="{{ Request::segment(3) }}">
                        {{-- <p>
                            <div class="form-group form-inline col-sm-6 col-sm-6 col-md-9 offset-md-2">
                                <input type="hidden" name="plan_id" id="plan_id" value="{{ Request::segment(3) }}">
                                <input type="text" name="promocode" class="form-control" id="inputpromocode2" placeholder="Enter Promo Code">
                                <button type="button" id="couponBtn" class="orangeBtn mb-2">Apply</button>
                            </div>
                        </p> --}}
                        <p><span id="discountPrice"></span></p>                        
                        {{-- <p><input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="AutoRenewal">Auto-Renewal</p>
                        <br>
                        <p> <h6>Total Price : <span>$19/Year</span></h6></p>
                        <br> --}}
                    </div>
                    <div class="card-footer text-muted">
                        {{-- <a href="{{ url('subscribe/plan/'.$planDetails->plan_id.'/checkout') }}" class="orangeBtn" style="min-width: 300px;padding: 15px 0;">Subscribe Now</a> --}}
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
                @endif

            </div>
        </div>

       
    </div>
</div>
<!-- top artist wrapper start -->

@endsection
<script
    src="https://www.paypal.com/sdk/js?client-id=ARDTLtYhBMTqfp6S7f5_LfsCdgjjJyHi58ro05JwCZQ4mVrTzfgNAqFpsX7DshidrZpXgK5o_KR7Tlpj&vault=true&intent=subscription">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        
        // $(document).ready(function(){
        //     plan_id = $('input[name=plan_id]').val();            
        // });
        
        paypal.Buttons({
            createSubscription: function(data, actions) {
              return actions.subscription.create({
                'plan_id': $('input[name=plan_id]').val() // Creates the subscription
              });
            },
            onApprove: function(returnData, actions) {
                subscriptionSuccess(returnData);
            }
          }).render('#paypal-button-container'); // Renders the PayPal button

        $(document).on('click','#couponBtn',function() {        
            var promocode = $('input[name=promocode]').val();
            var _token = $('input[name=_token]').val();
            // var id = $('input[name=id]').val();
            $.ajax({
                url:'{{ route("coupon.check") }}',
                type:'post',
                data:{"promocode":promocode, _token:_token},
                dataType:"json",
                success:function(data)
                {
                    $('#discountPrice').html('<span style="color:green;">Discount : ' +data.coupon.amount +' '+data.coupon.type+ ' applied!</span>');                 
                    $('input[name=plan_id]').val(data.coupon.plan_id);
                    $('#paypal-button-container').html('');
                    
                        paypal.Buttons({
                        createSubscription: function(data, actions) {
                            return actions.subscription.create({
                                'plan_id': $('input[name=plan_id]').val() // Creates the subscription
                            });
                            },
                            onApprove: function(returnData, actions) {
                                subscriptionSuccess(returnData);                                
                            }
                        }).render('#paypal-button-container'); // Renders the PayPal button
                     
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $('#discountPrice').html('<span style="color:red;">Coupon code is invalid!</span>');
                }
                
            });
            });

            
            function subscriptionSuccess(data) {
                var _token = $('input[name=_token]').val();
                $.ajax({
                url:'{{ route("subscriber.create") }}',
                type:'post',
                data:{"user_id":$('input[name=user_id]').val(), _token:_token,"subscriptionID":data.subscriptionID,"orderID":data.orderID,"billingToken":data.billingToken,"facilitatorAccessToken":data.facilitatorAccessToken,"paymentID":data.paymentID},
                dataType:"json",
                    success:function(data)
                    {
                        //alert('Subscription plan is activated.');
                        window.location.href = "{{url('/dashboard')}}";
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('something wrong, please try later.');

                        console.log("textStatus =", textStatus);
                        console.log("Error=", errorThrown);
                        console.log("XMLHttpRequest=", XMLHttpRequest);
                    }
                });
            };
       
</script>