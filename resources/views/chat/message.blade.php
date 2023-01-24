<div class="msg_head">
    <div class="img_cont">
        <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
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

<div class="msg_card_body">
    @if ($messages)
        @foreach ($messages as $message)
            @php
                $position = 'receiver_msg';
                $msg = 'msg_cotainer';
                $img = 'img_cont_msg';
                if (auth()->user()->id == $message->sender_id) {
                    $position = 'sender_msg';
                    $msg = 'msg_cotainer_send';
                    $img = '';
                }
            @endphp
            <div class="{{ $position }}">
                <div class="{{ $img }}">
                    @if ($message->sender_id != auth()->user()->id)
                        <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                            class="rounded-circle user_img_msg">
                    @endif
                </div>
                <div class="{{ $msg }}">
                    <p>{{ $message->message }}</p>
                    <span class="msg_time">{{ $message->getDateAttribute() }}</span>
                </div>
            </div>
        @endforeach
    @endif
</div>
<div class="message-footer">
    {{ Form::model($message, ['method' => $method, 'route' => $submitRoute]) }}
    {{ Form::hidden('receiver_id', request()->id) }}
    {{ Form::hidden('chat_id', $chatId) }}
    <div class="input-field">
        <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
        {{ Form::textarea('message', null, ['class' => 'type_msg', 'id' => 'text', 'placeholder' => 'Type your message...']) }}
        <button type="submit" class="send_btn" id="send-btn"><i class="fas fa-location-arrow"></i></button>
    </div>
    {{ Form::close() }}
</div>
