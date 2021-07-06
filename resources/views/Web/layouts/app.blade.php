<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{config('app.name')}}</title>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('logo.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('logo.png')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/normlaize.css')}}">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{asset('web/css/style-rtl.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{asset('web/css/style-ltr.css')}}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{asset('web/css/responsive.css')}}">
    @yield('style')
</head>
<body>
<div class="wrapper">
    @yield('out-content')
    @include('Web.layouts.header')
    <div id="Notifications">

    </div>
    @yield('content')
    @include('Web.layouts.footer')
</div>
<script src="{{asset('web/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web/js/main.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
@yield('script')
</body>
</html>
