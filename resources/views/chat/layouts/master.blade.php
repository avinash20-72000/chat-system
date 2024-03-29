<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <meta name="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/chat.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
</head>

@yield('chat-link')

<body>
    <div class="container">
        <div class="bar">
            <p class="logo">Chat | System</p>
            <ul>
                <li><a href="#"><i class="fa fa-bell"></i></li></a>
                @if(request()->is('profile/'.auth()->user()->id))
                    <li><a href="{{route('chatUsers')}}">Chat</a></li>
                @else
                    <li><a href="{{route('profile',['id' => auth()->user()->id])}}">Profile</a></li>
                @endif
                <li>
                    {{ Form::open(['method' => 'POST', 'route' => 'logout']) }}
                    @csrf
                    <button type="submit" class="btn btn-danger" style="margin: -10px">
                        Logout
                    </button>
                    {{ Form::close() }}
                </li>
            </ul>
        </div>
        <div class="chat-container">
            @yield('chat-content')
        </div>
    </div>
</body>

<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script>

    // setInterval(function() {
    //     $.ajax({
    //             url: "{{ route('onlineStatus') }}",
    //             type: 'get',
    //             dataType: 'json',
    //             success: function(response) {
    //                 console.log('hi');
    //             }
    //         });
    // }, 2000);


    
    $(function() {
            @if ($message = Session::get('success'))
                toastr.success('{{ $message }}');
            @endif
            @if ($message = Session::get('failure'))
                toastr.error('{{ $message }}');
            @endif
            @if ($message = Session::get('warning'))
                toastr.warning('{{ $message }}');
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.warning('{{ $error }}');
                @endforeach
            @endif

        });

    $(document).ready(function() {
        $('#action_menu_btn').click(function() {
            $('.action_menu').toggle();
        });
        $("#text").val("");
        $("#send-btn").attr("disabled", true);
    });

    // fixed issue of empty message send
    $('#text').on('input', function(e) {
        if ($('#text').val().length != 0 && $("#text").val().replace(/^\s+|\s+$/g, "").length != 0) {
            $("#send-btn").removeAttr("disabled");  
        } else {
            $("#send-btn").attr("disabled", true);
        }
    });

    // scroll chat 
    $(".msg_card_body").animate({
        scrollTop: $('.msg_card_body').get(0).scrollHeight
    });

    //notifications
    

    var path = "{{ url('get/user') }}";
    var chatRoute = "{{ route('messageBox', ':id') }}";
    $('#user_name').typeahead({

        source: function(query, process) {

            return $.get(path, {
                query: query
            }, function(data) {
                return process(data);
            });
        },
        updater: function(item) {
            url = chatRoute.replace(':id', item.id);
            $.ajax({
                // url: "{{ route('messageBox') }}",
                url: url,
                type: 'get',
                dataType: 'json',
                data: item,
                success: function(response) {
                    console.log(data);
                }
            });
        }
    });


    // chat scroll 
    window.onscroll = function() {
        scrollChat()
    };
    var header = $("#fixheader");
    var sticky = header.offsetTop;

    function scrollChat() {
        if ($(this).scrollTop() > 400 && $(this).width() >= 320) {
            header.addClass("sticky").removeClass("sticky-down");
        } else {
            header.removeClass("sticky").addClass("sticky-down");
        }
    };

</script>
@yield('chat-script')

</html>
