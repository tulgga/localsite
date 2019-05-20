<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/x-icon" href="{{ url('admin/images/favicon.png') }}"/>
    <title>Баянхонгор админ панел</title>

    <!-- Styles -->
    <link href="{{ url('admin/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <site-app></site-app>
</div>

<!-- Scripts -->
<script>
    window.surl = "{{ url('/') }}";
    window.subdomain = "{{ env('SUB_DOMAIN') }}";
</script>

<script src="{{url('admin/js/app.js?id=1')}}"></script>
<!-- <script src="{{url('ckeditor/ckeditor.js')}}"></script> -->
<script src="{{url('main/tinymce/tinymce.min.js')}}"></script>


</body>
</html>
