@extends('sub.layouts.site')
@section('meta')
    <title>Архив</title>
    <meta name="title" content="Архив">
    <meta name="description" content="Архив">
    <meta name="keywords" content="Архив">
@endsection
@section('content')
    <div class="row" style="background: #262b49;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('')}}">Нүүр хуудас</a><hex></hex></li>
                    <li class="breadcrumb-item active" aria-current="page">Архив</li>
                </ol>
                <div class="back-history"><a href="javascript:history.back(-1)">Өмнөх хуудас руу буцах</a></div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="posts-blog row">
                        <table class="table table-bordered" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th scope="col">№</th>
                                <th scope="col">Гарчиг</th>
                                <th scope="col">Огноо</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $s=1 @endphp
                            @foreach($newslist as $news)
                            <tr>
                                <th scope="row">{{$s}}</th>
                                <td>{{$news->title}}</td>
                                <td>{{$news->created_at}}</td>
                            </tr>
                            @php $s++; @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="background: rgba(38, 43, 73, 0.03)">
        <div class="container holboos">
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Аймгийн засаг даргын тамгын газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын ерөнхийлөгчийн тамгын газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын засгийн газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын их хурал</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/avilga.png')}}"> Авлигатай тэмцэх газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/soyombo.png')}}"> Эрх зүйн мэдээллийн нэгдсэн сан</a>
        </div>
    </div>
@endsection
@php function menu($menus,$parent_id, $activeC, $i){ @endphp
<ul>
    @php foreach($menus as $menu) :
if($menu->parent_id == $parent_id) { @endphp
    <li @if($activeC == $menu->id)class="active"@endif>
        <a href="{{asset("category/".$menu->id)}}">{{$menu->name}}</a>
        @php $i++;
$i = menu($menus,$menu->id, $activeC, $i); @endphp
    </li>
    @php } endforeach; @endphp
</ul>
@php } @endphp