<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>Test Application Admin Panel</title>

    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    @yield('links')

</head>
<body>
@yield('nav')

<div class="container-fluid">
    <div class="row">
        <div class="main">
            @yield('content')
        </div>
    </div>
</div>

@yield('footer')
</body>
</html>