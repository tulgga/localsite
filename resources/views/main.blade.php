<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/x-icon" href="{{$favicon}}"/>
    <title>{{$config['meta']['title']}}</title>
    <meta name="keywords" content="{{$config['meta']['keywords']}}">
    <meta name="description" content="{{$config['meta']['title']}}">

    <meta property="og:title" content="{{$config['meta']['title']}}">
    <meta property="og:image" content="{{$logo}}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:description" content="{{$config['meta']['description']}}">
    <!-- Styles -->
    {{$mainConfig['google_analytics']}}
    <link href="{{ url('main/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <site-app></site-app>
</div>

<!-- Scripts -->
<script>
    window.surl = "{{ url('/') }}";
    window.logo = "{{$logo}}";
    window.title = "{{$config['meta']['title']}}";
    window.google_api_key = "{{$mainConfig['google_api_key']}}";
    window.main = <?php echo json_encode($config['main']); ?>

    window.socail = <?php echo json_encode($config['socail']); ?>

    window.contact = <?php echo json_encode($config['contact']); ?>
</script>
<script src="{{ url('main/js/app.js?id=1') }}"></script>
</body>
</html>
