@extends('sub.layouts.site')
@section('meta')
    <title>{{$category->name}}</title>
    <meta name="title" content="{{$category->name}}">
    <meta name="description" content="{{$category->name}}">
    <meta name="keywords" content="{{$category->name}}">
@endsection
@section('content')
    <div class="row" style="background: #f9f9f9;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('')}}">Нүүр хуудас</a><hex></hex></li>
                    @foreach($category->menu as $index=>$menu)
                        @if(count($category->menu)-1!=$index)
                            <li class="breadcrumb-item"><a href="#">{{$menu['name']}}</a><hex></hex></li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{$menu['name']}}</li>
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
                    <div class="posts-blog row">
                        @foreach($newslist as $news)
                            @if($news->type == 2) {{--видео--}}
                                @if($category->order_num==3 || $category->order_num==4)
                                    <div class="news-blog col-sm-{{$category->order_num}}">
                                        <a class="row" href="{{asset('news/'.$news->id)}}">
                                            <div class="col-sm-12">
                                                <div class="thumb d-block w-100" style="background-image: url('https://i.ytimg.com/vi/{{$news->image}}/mqdefault.jpg');" title="{{$news->title}}">

                                                    <h2 style="font-size: 12px;
                                                        color: white;
                                                        text-align: justify;
                                                        padding: 10px;
                                                        line-height: 12px;
                                                        position: absolute;
                                                        bottom: -12px;
                                                        background: #ddd;
                                                        opacity: 0.9;
                                                        height: 50px;
                                                        overflow: hidden;
                                                        color: #262a49; width: 100%;">{{$news->title}}</h2>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <div class="news-blog col-sm-12">
                                        <a class="row" href="{{asset('news/'.$news->id)}}">
                                            <div class="col-sm-4">
                                                <div class="thumb d-block w-100 video" style="background-image: url('https://i.ytimg.com/vi/{{$news->image}}/mqdefault.jpg');" title="{{$news->title}}"><i class="fa fa-play"></i>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <h2>{{$news->title}}</h2>
                                                <div class="intro-text">{{mb_substr($news->short_content, 0, 350)}}...</div>
                                                <span class="create_date"><i class="far fa-clock"></i> {{$news->created_at->format('Y-m-d')}}</span>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @else
                                @if($category->order_num==3 || $category->order_num==4)
                                    <div class="news-blog col-sm-{{$category->order_num}}">
                                        <a class="row" href="{{asset('news/'.$news->id)}}">
                                            <div class="col-sm-12">
                                                <div class="thumb d-block w-100" style="background-image: url('{{asset(str_replace("images","uploads/medium/",$news->image))}}');" title="{{$news->title}}">

                                                    <h2 style="font-size: 12px;
                                                    color: white;
                                                    text-align: justify;
                                                    padding: 10px;
                                                    line-height: 12px;
                                                    position: absolute;
                                                    bottom: -12px;
                                                    background: #ddd;
                                                    opacity: 0.9;
                                                    height: 50px;
                                                    overflow: hidden;
                                                    color: #262a49; width: 100%;">{{$news->title}}</h2>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <div class="news-blog col-sm-12">
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
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-3">
                    <h3 class="head row"><span>Ангилал</span></h3>
                    <ul class="left-side-menu">
                        @php $i=1 @endphp

                        @foreach($categories as $cat)
                            @if($cat->parent_id == 0)
                                <li>
                                    <a href="{{asset("category/".$cat->id)}}">{{$cat->name}}</a>
                                    @php $i = menu($categories,$cat->id, $category->id, $i) @endphp
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
            <a href="http://bayankhongor.gov.mn" target="_blank"><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Аймгийн засаг даргын тамгын газар</a>
            <a href="https://president.mn/" target="_blank"><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын ерөнхийлөгчийн тамгын газар</a>
            <a href="https://zasag.mn/" target="_blank"><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын засгийн газар</a>
            <a href="http://www.parliament.mn/" target="_blank"><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын их хурал</a>
            <a href="https://www.iaac.mn/" target="_blank"><img src="{{ asset('main/sub/images/icons/avilga.png')}}"> Авлигатай тэмцэх газар</a>
            <a href="https://www.legalinfo.mn/" target="_blank"><img src="{{ asset('main/sub/images/icons/soyombo.png')}}"> Эрх зүйн мэдээллийн нэгдсэн сан</a>
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
