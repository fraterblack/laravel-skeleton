<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="{{ asset('images/favicon-16.png') }}" sizes="16x16" />
    <link rel="icon" href="{{ asset('images/favicon-32.png') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-144.png') }}" sizes="144x144">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-57.png') }}">

    {!! SEOMeta::generate() !!}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    @stack('head_extend')

    <link rel="stylesheet" href="{{ elixir('css/panel/components.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/panel/components-2.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/panel/general.css') }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>