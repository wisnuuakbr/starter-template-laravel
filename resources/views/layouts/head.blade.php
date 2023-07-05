<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')Dashboard - Template Builder</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- @section('head')
        <meta name="csrf_token" content="{{ csrf_token() }}" />
    @endsection --}}

    <!-- App Icons -->
    <link rel="shortcut icon" href="{{ asset('style') }}/assets/images/favicon.ico">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('style') }}/assets/plugins/morris/morris.css">

    <!-- Basic Css files -->
    <link href="{{ asset('style') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
