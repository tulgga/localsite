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
    <div class="row" style="background: #f9f9f9;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('')}}">Нүүр хуудас</a><hex></hex></li>
                    @foreach($page->menu as $index=>$menu)
                        @if(count($page->menu)-1!=$index)
                        <li class="breadcrumb-item active">{{$menu['title']}}<hex></hex></li>
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
                    <div class="post-detials">
                        <div class="post_header">{{$page->title}}</div>
                        <result>
                            <div>
                                <div style="display: inline-flex;">
                                    <a name="twitter_share" data-count="horizontal" href="http://twitter.com/share?url=&amp{{asset('news/'.$page->id)}};" class="twitter-share-button" >Tweet</a>
                                </div>
                                <div style="display: inline-flex;">
                                    <div id="fb-root"></div>
                                    <script>(function(d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (d.getElementById(id)) return;
                                            js = d.createElement(s); js.id = id;
                                            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));</script>
                                    <div class="fb-like" data-href="{{asset('news/'.$page->id)}}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                                </div>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            </div>
                        </result>
                        <div class="post_content">
                            @if($page->image)
                            <img class="single_new_img" src="{{asset('uploads/'.$page->image)}}">
                            @endif
                            {!!$page->text!!}
                        </div>
                        <result style="margin-top:15px;">
                            <div style="display: inline-block;">
                                <div style="display: inline-flex;">
                                    <a name="twitter_share" data-count="horizontal" href="http://twitter.com/share?url=&amp{{asset('news/'.$page->id)}};" class="twitter-share-button" >Tweet</a>
                                </div>
                                <div style="display: inline-flex;">
                                    <div id="fb-root"></div>
                                    <script>(function(d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (d.getElementById(id)) return;
                                            js = d.createElement(s); js.id = id;
                                            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));</script>
                                    <div class="fb-like" data-href="{{asset('news/'.$page->id)}}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                                </div>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            </div>
                        </result>
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
