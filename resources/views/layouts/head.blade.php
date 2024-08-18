<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')Dashboard - Template Builder</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Custom Style --}}
    <style>
        /* form error */
        .is-invalid {
            border-color: red;
            background-color: #fdd;
        }

        input.error-placeholder::placeholder {
            color: red !important;
            font-style: italic !important;
        }
    </style>

    <!-- App Icons -->
    <link rel="shortcut icon" href="{{ asset('style') }}/assets/images/favicon.ico">

    <!-- Basic Css files -->
    <link href="{{ asset('style') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('style') }}/assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- Plugins -->
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" />
</head>
