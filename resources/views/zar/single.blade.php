@extends('zar.body')
@section('meta')
    <title>{{$zar->title}}</title>
    <meta name="title" content="{{$zar->title}}">
    <meta name="description" content="{{$zar->content}}">
    <meta name="image" content="{{url('images/noImage.jpg')}}">



    <meta property="og:url" content="{{url('c/'.$selected_cat->id.'.html')}}">
    <meta property="og:type" content="category">
    <meta property="og:title" content="{{$zar->title}}">
    @if($zar->image)
    <meta property="og:image" content="{{url('uploads/'.$zar->image)}}">
    @else
    <meta property="og:image" content="{{url('images/noImage.jpg')}}">
    @endif
    <meta property="og:image:width" content="750">
    <meta property="og:image:height" content="500">
    <meta property="og:locale" content="mn_MN">
    <meta property="og:locale:alternate" content="en_GB">
    <meta property="og:description" content="{{$zar->content}}">
@endsection
@section('content')
    <div class="gradient-title">
        <h2>Ангилал: {{$selected_cat->name}}</h2>
    </div>
    <div class="gradient-padding reduce-padding">
        <div class="section-title-left-dark child-size-xl title-bar item-mb">
            <h3>{{$zar->title}}</h3>
            <p>{{$zar->content}}</p>
        </div>
        <ul class="sidebar-item-details p-none mb-4">
            <li>Үнэ:<span>{{$zar->price}}₮</span></li>
            <li>Утас:<span>{{$zar->phone}}</span></li>
            <li>Имэйл:<span>{{$zar->email}}</span></li>
        </ul>
        <div class="clearfix"></div>

        <div class="text-center">
            @if($zar->image)
            <img src="{{url('uploads/'.$zar->image)}}"  class="img-fluid">
            @endif
            @if($images)
                @foreach($images as $image):
                <img src="{{url('uploads/'.$image->image)}}"  class="img-fluid mt-3">
                @endforeach
            @endif

        </div>
        <ul class="item-actions border-top">
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
        </ul>
    </div>
@endsection