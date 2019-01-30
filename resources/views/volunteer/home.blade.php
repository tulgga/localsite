@extends('volunteer.body')
@section('meta')
    <title>Volunteer | Сайн дурынхан</title>
    <meta name="title" content="Volunteer | Сайн дурынхан">
    <meta name="keywords" content="Volunteer | Сайн дурынхан">
    <meta name="description" content="Volunteer | Сайн дурынхан">
@endsection
@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset("main/volunteer/images/slide/001.jpg")}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset("main/volunteer/images/slide/002.jpg")}}" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
@endsection