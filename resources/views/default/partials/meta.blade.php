<!doctype html>
<html lang="en" class="no-js">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', setting('site.title'))</title>
    <meta name="description" content="@yield('meta_description')">

    <!-- Open Graph -->
    <meta property="og:site_name" content="{{ setting('site.title') }}" />
    <meta property="og:title" content="@yield('meta_title')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:image" content="@yield('meta_image', url('/') . '/images/apple-touch-icon.png')" />
    <meta property="og:description" content="@yield('meta_description', setting('site.description'))" />

    <!-- Icons -->
    <meta name="msapplication-TileImage" content="{{ url('/') }}/ms-tile-icon.png" />
    <meta name="msapplication-TileColor" content="#8cc641" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Styles -->
    @stack('styles')
    <!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="{{ url('/') }}/style.css" type="text/css" />
	<link rel="stylesheet" href="{{ url('/') }}/css/dark.css" type="text/css" />
	<link rel="stylesheet" href="{{ url('/') }}/css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="{{ url('/') }}/css/animate.css" type="text/css" />
	<link rel="stylesheet" href="{{ url('/') }}/css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="{{ url('/') }}/css/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/frontend.css"> --}}

    @if (setting('site.google_analytics_tracking_id'))
    <!-- Google Analytics (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('site.google_analytics_tracking_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{ setting('site.google_analytics_tracking_id') }}');
        </script>
    @endif
    @if (setting('admin.google_recaptcha_site_key'))
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
        <script>
            function setFormId(formId) {
                window.formId = formId;
            }

            function onSubmit(token) {
                document.getElementById(window.formId).submit();
            }
        </script>
    @endif

</head>
<body>
