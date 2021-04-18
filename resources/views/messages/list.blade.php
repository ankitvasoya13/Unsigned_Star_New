<style>
    .pending {
        /* position: absolute; */
        float: right;
        /* left: 13px; */
        /* top: 9px; */
        background: #f84a3e;
        margin: 0;
        border-radius: 50%;
        width: 10px;
        height: 10px;
        line-height: 10px;
        padding-left: 5px;
        color: #ffffff;
        font-size: 12px;
        margin-top: -20px;
    }
</style>

@foreach ($chatUsers as $chatUser)
<div class="chat_list {{$receiverId == $chatUser->id ? 'active_chat':''}}"
    onclick="changeChatUser('{{$chatUser->id}}')">
    <div class="chat_people">
        <div class="chat_img">
            @if ($chatUser->profile_image)
            <img src="{{asset('uploads/' . $chatUser->profile_image)}}" alt="">
            @else
            <img src="{{asset('uploads/tp3.png')}}" alt="">
            @endif

        </div>
        <div class="chat_ib">
            <h5>{{$chatUser->first_name.' '.$chatUser->last_name}} <span class="chat_date"></span></h5>
            <p></p>
            @if($chatUser->unread && !$chatUser->is_read && $receiverId != $chatUser->id)
            <span class="pending"></span>
            @endif
        </div>

    </div>
</div>
@endforeach