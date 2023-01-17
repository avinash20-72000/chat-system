<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <meta name="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/chat.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
    </script>

</head>

@yield('chat-link')

<body>
    <div class="container-fluid h-100">
        {{ Form::open(['method'=>'POST', 'route' =>'logout', 'class' => 'float-right mt-4'])}}
        @csrf
        <button type="submit" class="btn btn-danger" >
            Logout
        </button>
        {{ Form::close() }}
        <div class="row justify-content-center h-100">
            @yield('chat-content')
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
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
                // url: "{{route('messageBox')}}",
                url: url,
                type: 'get',
                dataType: 'json',
                data:item,
                success: function (response) {
                    console.log(data);
                }
            });
            }
        });
</script>
@yield('chat-script')

</html>
