@extends('sub.layouts.site')
@section('meta')
    <title>{{$category->name}}</title>
    <meta name="title" content="{{$category->name}}">
    <meta name="description" content="{{$category->name}}">
    <meta name="keywords" content="{{$category->name}}">
@endsection
@section('content')
    <?php $now_selected= null;?>
    <div class="row" style="background: #f9f9f9;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('')}}">Нүүр хуудас</a><hex></hex></li>
                    @foreach($category->menu as $index=>$menu)
                        @if(count($category->menu)-1!=$index)
                            <li class="breadcrumb-item"><a href="#">{{$menu['name']}}</a><hex></hex></li>
                        @else
                            <?php $now_selected =$menu; ?>
                            <li class="breadcrumb-item active" aria-current="page">{{$menu['name']}}</li>
                        @endif
                    @endforeach
                </ol>
                <div class="back-history"><a href="javascript:history.back(-1)">Өмнөх хуудас руу буцах</a></div>
            </nav>
        </div>
    </div>
    @if($list_type==3)
        <div class="timeline-container" id="timeline-1">
          <div class="timeline-header">
            <h2 class="timeline-header__title">{{$now_selected['name']}}</h2>
          </div>
          <div class="timeline">
            <?php $index=1;?>
    	    @foreach($newslist as $news)
                <?php $img = ($news->type == 2) ? "https://i.ytimg.com/vi/{{$news->image}}/mqdefault.jpg" : asset(str_replace("images","uploads/medium/",$news->image)); ?>
               <div class="timeline-item" data-text="{{$news->short_content}}">
                  <div class="timeline__content"><img class="timeline__img" src="{{$img}}"/>
                    <h2 class="timeline__content-title">{{mb_substr($news->short_content, 0, 50)}}</h2>
                    <p class="timeline__content-desc">{!!$news->contant !!}</p>
                  </div>
                </div>
        		<?php $index= $index+1?>
            @endforeach
          </div>
        </div>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
        <script >
        (function($) {
        $.fn.timeline = function() {
        var selectors = {
          id: $(this),
          item: $(this).find(".timeline-item"),
          activeClass: "timeline-item--active",
          img: ".timeline__img"
        };
        selectors.item.eq(0).addClass(selectors.activeClass);
        selectors.id.css(
          "background-image",
          "url(" +
            selectors.item
              .first()
              .find(selectors.img)
              .attr("src") +
            ")"
        );
        var itemLength = selectors.item.length;
        $(window).scroll(function() {
          var max, min;
          var pos = $(this).scrollTop();
          selectors.item.each(function(i) {
            min = $(this).offset().top;
            max = $(this).height() + $(this).offset().top;
            var that = $(this);
            if (i == itemLength - 2 && pos > min + $(this).height() / 2) {
              selectors.item.removeClass(selectors.activeClass);
              selectors.id.css(
                "background-image",
                "url(" +
                  selectors.item
                    .last()
                    .find(selectors.img)
                    .attr("src") +
                  ")"
              );
              selectors.item.last().addClass(selectors.activeClass);
            } else if (pos <= max - 40 && pos >= min) {
              selectors.id.css(
                "background-image",
                "url(" +
                  $(this)
                    .find(selectors.img)
                    .attr("src") +
                  ")"
              );
              selectors.item.removeClass(selectors.activeClass);
              $(this).addClass(selectors.activeClass);
            }
          });
        });
        };
        })(jQuery);
        
        $("#timeline-1").timeline();
        </script>
    @else
        <div class="row">
            <div class="container content-box">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="posts-blog row">
                        
                            @foreach($newslist as $news)
                                <?php $img = ($news->type == 2) ? "https://i.ytimg.com/vi/{{$news->image}}/mqdefault.jpg" : asset(str_replace("images","uploads/medium/",$news->image)); ?>
                                @if($list_type==0)
                                    <div class="news-blog col-sm-12">
                                        <a class="row" href="{{asset('news/'.$news->id)}}">
                                            <div class="col-sm-4">
                                                <div class="thumb rounded d-block w-100 video" style="background-image: url('{{$img}}');" title="{{$news->title}}">
                                                    <i class="fa fa-play"></i>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <h2>{{$news->title}}</h2>
                                                <div class="intro-text">{{mb_substr($news->short_content, 0, 350)}}...</div>
                                                <span class="create_date"><i class="far fa-clock"></i> {{$news->created_at->format('Y-m-d')}}</span>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <div class="news-blog col-sm-{{$list_type+2}}">
                                        <a class="row" href="{{asset('news/'.$news->id)}}">
                                            <div class="col-sm-12">
                                                <div class="thumb rounded d-block w-100" style="background-image: url('{{$img}}');" title="{{$news->title}}">
                                                    <h4>{{$news->title}}</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
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
    @endif
@endsection
