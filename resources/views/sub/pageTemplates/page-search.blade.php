@extends('sub.layouts.site')
@section('meta')
    <title></title>
    <meta name="title" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
@endsection
@section('content')
    <div class="row" style="background: #f9f9f9;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('')}}">Нүүр хуудас</a><hex></hex></li>
                    <li class="breadcrumb-item active" aria-current="page">Хайлтын хэсэг</li>
                </ol>
                <div class="back-history"><a href="javascript:history.back(-1)">Өмнөх хуудас руу буцах</a></div>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-9">
                    <div class="posts-blog">
                        @foreach($posts as $post)
                            <div class="news-list">
                                <a href="#">{{$post->title}}...</a>
                                <p>{{$post->short_content}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-3">
                    @if($info->sidebar)
                        <h3 class="head row"><span>Суртчилгаа</span></h3>
                        {!! $info->sidebar !!}
                    @endif
                    @if($info->config['socail']['facebook'])
                        <h3 class="head row"><span>Биднийг дэмжээрэй</span></h3>
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.3"></script>
                        <div class="fb-page" data-href="{{$info->config['socail']['facebook']}}" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="{{$info->config['socail']['facebook']}}" class="fb-xfbml-parse-ignore"><a href="{{$info->config['socail']['facebook']}}">{{$info->name}}</a></blockquote>
                        </div>
                    @endif
                    @if($zar)
                        <h3 class="head row background-white"><span>ЗАР МЭДЭЭ</span></h3>
                        <ul class="row iltod_news background-white">
                            <div class="iltod_scroll scrollbar-inner">
                                @foreach($zar as $zr)
                                    <li class="row">
                                        <div class="col-sm-4">
                                            <div class="zar_thumb" style="background-image: url('{{asset('uploads')}}/{{$zr->image}}')"></div>
                                        </div>
                                        <div class="col-sm-8">
                                            <a href="http://zar.{{$home_url->domain}}/p/{{$zr->id}}.html">{{mb_substr($zr->title, 0, 55)}}...</a>
                                            <span class="create_date"><i class="far fa-clock"></i> {{$zr->created_at}}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </div>
                        </ul>
                    @endif
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
