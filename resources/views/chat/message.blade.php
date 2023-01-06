<div class="card">
    <div class="card-header msg_head">
        <div class="d-flex bd-highlight">
            <div class="img_cont">
                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                    class="rounded-circle user_img">
                <span class="online_icon"></span>
            </div>
            <div class="user_info">
                <span>{{ ucFirst($userName) }}</span>
                <p>1767 Messages</p>
            </div>
            <div class="video_cam">
                <span><i class="fas fa-video"></i></span>
                <span><i class="fas fa-phone"></i></span>
            </div>
        </div>
        <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
        <div class="action_menu">
            <ul>
                <li><i class="fas fa-user-circle"></i> View profile</li>
                <li><i class="fas fa-users"></i> Add to close friends</li>
                <li><i class="fas fa-plus"></i> Add to group</li>
                <li><i class="fas fa-ban"></i> Block</li>
            </ul>
        </div>
    </div>
    <div class="card-body msg_card_body">
        @if($messages)
            @foreach($messages as $message)
                @php
                    $position = 'justify-content-start';
                    $msg      = 'msg_cotainer';
                    if (auth()->user()->id == $message->sender_id) {
                        $position = 'justify-content-end';
                        $msg      = 'msg_cotainer_send';
                    }
                @endphp
                <div class="d-flex {{$position}} mb-4">
                    <div class="img_cont_msg">
                        @if($message->sender_id != auth()->user()->id)
                        <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                            class="rounded-circle user_img_msg">
                            @endif
                    </div>
                    <div class="{{ $msg }}">
                        {{$message->message}}
                        <span class="msg_time" >{{$message->getDateAttribute()}}</span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="card-footer">
        {{Form::model($message,['method'=>$method,'route'=>$submitRoute])}}
        {{ Form::hidden('receiver_id', request()->id) }}
        {{ Form::hidden('chat_id', $chatId) }}
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                </div>
                {{ Form::textarea('message', null, ['class'=> 'form-control type_msg','id'=>'text','placeholder'=>'Type your message...']) }}
                <div class="input-group-append">
                    <button type="submit" class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>
                </div>
            </div>
        {{Form::close()}}
    </div>
</div>