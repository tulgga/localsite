@extends('sub.layouts.site')
@section('meta')
        <title>{{$page->title}}</title>
        <meta name="title" content="{{$page->title}}">
        <meta name="description" content="{{mb_substr(strip_tags($page->text), 0, 250)}}">
        <meta name="keywords" content="{{$page->title}}">

        <meta name="twitter:title" content="{{$page->title}}">
        <meta name="twitter:description" content="{{mb_substr(strip_tags($page->text), 0, 250)}}">
        <meta name="twitter:url" content="{{asset('news/'.$page->id)}}">
        <meta name="twitter:image" content="{{asset('uploads/'.$page->image)}}">

        <meta property="og:title" content="{{$page->title}}">
        <meta property="og:description" content="{{mb_substr(strip_tags($page->text), 0, 250)}}">
        <meta property="og:image" content="{{asset('uploads/'.$page->image)}}">
@endsection
@section('content')
    <div class="row" style="background: #262b49;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('')}}">Нүүр хуудас</a><hex></hex></li>
                    @foreach($page->menu as $index=>$menu)
                        @if(count($page->menu)-1!=$index)
                        <li class="breadcrumb-item"><a href="#">{{$menu['title']}}</a><hex></hex></li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{$menu['title']}}</li>
                        @endif
                    @endforeach
                </ol>
                <div class="back-history"><a href="javascript:history.back(-1)">Өмнөх хуудас руу буцах</a></div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-9">
                    @if($page->type == 0)
                        @component('sub.pageTemplates.page-content', ['page'=>$page]) @endcomponent
                    @elseif($page->type == 2)
                        @component('sub.pageTemplates.page-posts',  ['page'=>$page,'newslist'=>$newslist]) @endcomponent
                    @endif
                </div>
                <div class="col-sm-3">
                    @foreach($info->menu as $menu)
                        @if($menu->id == $page['menu'][0]['id'])
                    <h3 class="head row"><span>{{$menu->name}}</span></h3>
                    <ul class="left-side-menu">
                        @foreach($menu->children as $submenu)
                        <li @if($page['menu'][1]['id'] == $submenu->id)class="active"@endif>
                            <a href="{{$submenu->link}}">{{$submenu->name}}</a>
                            @if($submenu->children)
                            <ul>
                                @foreach($submenu->children as $submenu2)
                                <li @if($page['menu'][2]['id'] == $submenu2->id)class="active"@endif>
                                    <a href="{{$submenu2->link}}">{{$submenu2->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                                @endif
                        </li>
                        @endforeach
                    </ul>
                        @endif
                    @endforeach
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