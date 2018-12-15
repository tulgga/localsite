@extends('sub.layouts.site')
@section('meta')
    <title>{{$news->title}}</title>
    <meta name="title" content="{{$news->title}}">
    <meta name="description" content="{{mb_substr(strip_tags($news->content), 0, 250)}}">
    <meta name="keywords" content="{{$news->title}}">

    <meta name="twitter:title" content="{{$news->title}}">
    <meta name="twitter:description" content="{{mb_substr(strip_tags($news->content), 0, 250)}}">
    <meta name="twitter:url" content="{{asset('news/'.$news->id)}}">
    <meta name="twitter:image" content="{{asset('uploads/'.$news->image)}}">

    <meta property="og:title" content="{{$news->title}}">
    <meta property="og:description" content="{{mb_substr(strip_tags($news->content), 0, 250)}}">
    <meta property="og:image" content="{{asset('uploads/'.$news->image)}}">
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
                    <div class="post-detials">
                        <div class="post_header">{{$news->title}}</div>
                        <result>
                            <span title="Нийтэлсэн"><i class="far fa-clock"></i> {{$news->created_at}}</span>
                            <span title="Уншсан"><i class="fa fa-users"></i> {{$news->view_count}}</span>
                            <div style="float: right;">
                                <div style="display: inline-flex;">
                                    <script src="https://apis.google.com/js/platform.js" async defer></script>
                                    <div class="g-plus" data-action="share" data-annotation="bubble" data-href="{{asset('news/'.$news->id)}}"></div>
                                </div>
                                <div style="display: inline-flex;">
                                    <a name="twitter_share" data-count="horizontal" href="http://twitter.com/share?url=&amp{{asset('news/'.$news->id)}};" class="twitter-share-button" >Tweet</a>
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
                                    <div class="fb-like" data-href="{{asset('news/'.$news->id)}}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                                </div>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            </div>
                        </result>
                        <div class="post_content">
                            <img class="single_new_img" src="{{asset('uploads/'.$news->image)}}">
                            {!!$news->content!!}
                        </div>
                            <result style="margin-top:15px; text-align: right;">
                                <div style="display: inline-block;">
                                    <div style="display: inline-flex;">
                                        <script src="https://apis.google.com/js/platform.js" async defer></script>
                                        <div class="g-plus" data-action="share" data-annotation="bubble" data-href="{{asset('news/'.$news->id)}}"></div>
                                    </div>
                                    <div style="display: inline-flex;">
                                        <a name="twitter_share" data-count="horizontal" href="http://twitter.com/share?url=&amp{{asset('news/'.$news->id)}};" class="twitter-share-button" >Tweet</a>
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
                                        <div class="fb-like" data-href="{{asset('news/'.$news->id)}}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                                    </div>
                                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                </div>
                            </result>
                        <div class="categories">
                            <h4>Ангилалууд</h4>
                            <ul>
                            @foreach($news->category as $dd)
                                <li><a href="{{asset('p/'.$dd->id)}}">&bull; &nbsp;&nbsp;{{$dd->name}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h3 class="head row"><span>Ил тод байдал</span></h3>
                    <ul class="left-side-menu">
                        <li>
                            <a href="http://bayanovoo.khongor.gov.mn/menu_all/170">Төсөв санхүү</a>
                            <ul>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/174">Төсөв</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/175">Төсвийн гүйцэтгэл,сарын мэдээ</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/176">Аудитын дүгнэлт,зөвлөмж</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/177">5 сая + орлого,зарлага</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/178">Орон нутгийн хөгжлийн сан</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/179">Орон нутгийн нөөц хөрөнгө</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/180">Сум хөгжүүлэх сан</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://bayanovoo.khongor.gov.mn/menu_all/171">Хүний нөөц</a>
                            <ul>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/181">Сул орон тоо</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/182">Сонгон шалгаруулалт</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/183">Мэдээ тайлан</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://bayanovoo.khongor.gov.mn/menu_all/172">Худалдан авах ажиллагаа</a>
                            <ul>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/184">Тендер</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/185">Тайлан мэдээ</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://bayanovoo.khongor.gov.mn/menu_all/173">Үйл ажиллагаа</a>
                            <ul>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/186">Авилгын эсрэг үйл ажиллагааны төлөвлөгөө,тайлан</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/187">Тусгай зөвшөөрөл</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/188">Үйлчилгээний төлбөр хураамж</a>
                                </li>
                            </ul>
                        </li>
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