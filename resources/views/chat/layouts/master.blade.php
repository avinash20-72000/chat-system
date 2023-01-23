{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->

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
</head>

@yield('chat-link')

<body>
    <div class="container">
        <div class="bar">
            <p class="logo">Chat | System</p>
            <ul>
                <li><a href="#"><i class="fa fa-bell"></i></li></a>
                <li><a href="#">Profile</a></li>
            </ul>
        </div>
        {{-- {{ Form::open(['method'=>'POST', 'route' =>'logout', 'class' => 'float-right mt-4'])}}
        @csrf
        <button type="submit" class="btn btn-danger" >
            Logout
        </button>
        {{ Form::close() }} --}}
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
<script>
    $(document).ready(function() {
        $('#action_menu_btn').click(function() {
            $('.action_menu').toggle();
        });
        $("#text").val("");
    });

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


    // user search fixed position
    window.onscroll = function () {
        myFunction()
    };
    var header = $("#fixheader");
    var sticky = header.offsetTop;
    function myFunction() {
        if ($(this).scrollTop() > 400 && $(this).width() >= 320) {
            header.addClass("sticky").removeClass("sticky-down");
        }
        else {
            header.removeClass("sticky").addClass("sticky-down");
        }
    };
</script>
@yield('chat-script')

</html>
