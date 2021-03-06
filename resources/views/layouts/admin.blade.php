<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie" dir="ltr" lang="en-US">
<![endif]-->
<!--[if !IE]>
<html dir="ltr" lang="en-US">
<![endif]-->

<!-- START HEAD -->
<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- this line will appear only if the website is visited with an iPad -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title }}</title>

    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('settings.theme')) }}images/favicon.png" />
    <link rel="icon" type="image/x-icon" href="{{ asset(config('settings.theme')) }}images/favicon.png" />

    <!-- FONTs -->
    <link rel="stylesheet" id="google-fonts-css" href="http://fonts.googleapis.com/css?family=Oswald%7CDroid+Sans%7CPlayfair+Display%7COpen+Sans+Condensed%3A300%7CRokkitt%7CShadows+Into+Light%7CAbel%7CDamion%7CMontez&amp;ver=3.4.2" type="text/css" media="all" />

    <!-- JAVASCRIPTs -->
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}js/script.js"></script>
    <script type="text/javascript" src="{{ asset(config('settings.theme')) }}js/jquery.stickytableheaders.js"></script>

    <!-- CSSs -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset(config('settings.theme')) }}css/style.css" />
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset(config('settings.theme')) }}css/bootstrap.css" />


</head>
<!-- END HEAD -->

<!-- START BODY -->
<body>

@yield('navigation')

@yield('header')

@yield('content')

@yield('footer')

</body>
<!-- END BODY -->
</html>