@foreach ($messages as $message)
@if ($message->sender === $sender)
<div class="outgoing_msg">
    <div class="sent_msg">
        <p>{{$message->message}}</p>
        <span class="time_date">{{date('h:i A | m/d/Y', strtotime($message->created_at))}}</span>
    </div>
</div>
@else
<div class="incoming_msg">
    <div class="incoming_msg_img"> <img src="{{ asset('uploads/'.$receiverUser->profile_image)}}" alt=""> </div>
    <div class="received_msg">
        <div class="received_withd_msg">
            <p>{{$message->message}}</p>
            <span
                class="time_date">{{$receiverUser->first_name . ' ' . $receiverUser->last_name . ' ' . date('h:i A | m/d/Y', strtotime($message->created_at)) }}</span>
        </div>
    </div>
</div>
@endif

@endforeach