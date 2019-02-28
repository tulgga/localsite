@extends('zar.body')
@section('meta')
    <title></title>
    <meta name="title" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
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
            <img src="{{url('uploads/'.$zar->image)}}" alt="categories" class="img-fluid">
        </div>
        <ul class="item-actions border-top">
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
        </ul>
    </div>
@endsection