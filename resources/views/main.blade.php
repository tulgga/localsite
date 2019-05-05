
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
    @if($news)
        <meta property="og:title" content="{{$news['title']}}">
        <meta property="og:image" content="{{url('/uploads/'.$news['image'])}}">
        <meta property="og:url" content="{{ url('/!?id='.$news['id'].'#/news/'.$news['id']) }}">
        <meta property="og:type" content="article">
        <meta property="og:description" content="{{$news['short_content']}}">
    @else
        <meta name="keywords" content="{{$config['meta']['keywords']}}">
        <meta name="description" content="{{$config['meta']['title']}}">
        <meta property="og:title" content="{{$config['meta']['title']}}">
        <meta property="og:image" content="{{$logo}}">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:description" content="{{$config['meta']['description']}}">
    @endif

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
    console.log(window.location.hash);
    window.surl = "{{ url('/') }}";
    window.sdate = "{{ $date }}";
    window.subdomain = "{{ env('SUB_DOMAIN') }}";
    window.logo = "{{$logo}}";
    window.icon = "{{$favicon}}";
    window.title = "{{$config['meta']['title']}}";
    window.google_api_key = "{{$mainConfig['google_api_key']}}";
    window.meta = <?php echo json_encode($config['meta']); ?>;
    window.main = <?php echo json_encode($config['main']); ?>;
    window.socail = <?php echo json_encode($config['socail']); ?>;
    window.contact = <?php echo json_encode($config['contact']); ?>;
</script>
<script src="{{ url('main/js/app.js?id=1') }}"></script>
</body>
</html>
