@extends('sub.layouts.site')
@section('meta')
    <title>{{$category->name}}</title>
    <meta name="title" content="{{$category->name}}">
    <meta name="description" content="{{$category->name}}">
    <meta name="keywords" content="{{$category->name}}">
@endsection
@section('content')
    <div class="row" style="background: #262b49;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a><hex></hex></li>
                    <li class="breadcrumb-item"><a href="#">Library</a><hex></hex></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
                <div class="back-history"><a href="javascript:history.back(-1)">Өмнөх хуудас руу буцах</a></div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-9">
                    <div class="posts-blog row" style="padding-right: 60px;">
                        @foreach($newslist as $news)
                            <div class="news-blog">
                                <a class="row" href="{{asset('news/'.$news->id)}}">
                                    <div class="col-sm-4">
                                        <div class="thumb d-block w-100" style="background-image: url('{{asset(str_replace("images","uploads/medium/",$news->image))}}');" title="{{$news->title}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <h2>{{$news->title}}</h2>
                                        <div class="intro-text">{{mb_substr($news->short_content, 0, 350)}}...</div>
                                        <span class="create_date"><i class="far fa-clock"></i> {{$news->created_at->format('Y-m-d')}}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-3">
                    <h3 class="head row"><span>Мэдээний ангилал</span></h3>
                    <ul class="left-side-menu">
                        @php $i=1 @endphp
                        @foreach($categories as $cat)
                            @if($cat->parent_id == 0)
                                <li>
                                    <a href="#">{{$cat->name}}</a>
                                    @php $i = menu($categories,$cat->id, $i) @endphp
                                </li>
                            @endif
                        @endforeach
                    </ul>
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
@php function menu($menus,$parent_id, $i){ @endphp
<ul>
    @php foreach($menus as $menu) :
if($menu->parent_id == $parent_id) { @endphp
    <li>
        <a href="{{asset("category/".$menu->id)}}">{{$menu->name}}</a>
        @php $i++;
$i = menu($menus,$menu->id, $i); @endphp
    </li>
    @php } endforeach; @endphp
</ul>
@php } @endphp