@extends('sub.layouts.site')
@section('meta')
    <title>{{$info->config['meta']['title']}}</title>
    <meta name="title" content="{{$info->config['meta']['title']}}">
    <meta name="keywords" content="{{$info->config['meta']['keywords']}}">
    <meta name="description" content="{{$info->config['meta']['description']}}">
@endsection
@section('content')
    <div class="row feature-news">
        <div class="container">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @php $i=1; @endphp
                    @foreach($ontslokh as $news)
                    <div class="carousel-item @if($i==1) active @endif">
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <div class="thumb d-block w-100" style="background-image: url('{{asset(str_replace("images","uploads/medium/",$news->image))}}');" title="{{$news->title}}">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <h2>{{$news->title}}</h2>
                                <div class="intro-text">{{mb_substr($news->short_content, 0, 500)}}</div>
                                <a href="{{asset('news/'.$news->id)}}" class="btn-readmore">Дэлгэрэнгүй&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>
                     @php $i++; @endphp
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="fa fa-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="fa fa-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row links">
        <div class="container">
            <div class="row" style="display: block;text-align: center;">
                @foreach($other_menu as $menu)
                    @if($menu->type == 1)
                    <a href="{{$menu->link}}"><i class="{{$menu->icon}}"></i> {!!html_entity_decode($menu->name)!!}</a>
                    @elseif($menu->type == 2)
                        <a href="{{asset('category/'.$menu->type_id)}}"><i class="{{$menu->icon}}"></i> {!!html_entity_decode($menu->name)!!}</a>
                    @elseif($menu->type == 4)
                        <a href="{{asset('files/'.$menu->type_id)}}"><i class="{{$menu->icon}}"></i> {!!html_entity_decode($menu->name)!!}</a>
                    @elseif($menu->type == 5)
                        <a href="{{asset($menu->link)}}"><i class="{{$menu->icon}}"></i> {!!html_entity_decode($menu->name)!!}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="head latest row"><span>Шинэ мэдээ</span></h3>
                    <ul class="row latest_news">
                        @foreach($latest_news as $nws)
                            @if($nws->type == 0)
                                <li class="col-sm-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="thumb" style="background-image: url('{{asset(str_replace("images","uploads/small",$nws->image))}}');" title="{{$nws->title}}"></div>
                                        </div>
                                        <div class="col-7">
                                            <a href="{{asset('news/'.$nws->id)}}"><h6>{{mb_substr($nws->title, 0, 55)}}...</h6></a>
                                            <span class="create_date"><i class="far fa-clock"></i> {{$nws->created_at->format('Y-m-d')}}</span>
                                        </div>
                                    </div>
                                </li>
                            @elseif($nws->type == 1)
                                <li class="col-sm-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="thumb photo" style="background-image: url('{{asset(str_replace("images","uploads/small/",$nws->image))}}');" title="{{$nws->title}}">
                                                <i class="far fa-images"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <a href="{{asset('news/'.$nws->id)}}"><h6>{{mb_substr($nws->title, 0, 55)}}...</h6></a>
                                            <span class="create_date"><i class="far fa-clock"></i> {{$nws->created_at->format('Y-m-d')}}</span>
                                        </div>
                                    </div>
                                </li>
                            @elseif($nws->type == 2)
                                <li class="col-sm-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="thumb video" style="background-image: url('https://i.ytimg.com/vi/{{$nws->image}}/mqdefault.jpg');" title="{{$nws->title}}"><i class="fa fa-play"></i></div>
                                        </div>
                                        <div class="col-7">
                                            <a href="{{asset('news/'.$nws->id)}}"><h6>{{mb_substr($nws->title, 0, 55)}}...</h6></a>
                                            <span class="create_date"><i class="far fa-clock"></i> {{$nws->created_at->format('Y-m-d')}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h3 class="head row"><span>Ил тод байдал</span></h3>
                    <ul class="row iltod_news">
                        <div class="iltod_scroll scrollbar-inner">
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">2018 оны 12 сар | Төсөв санхүү</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">2018 оны 12 сар | Төсөв санхүү</span>
                            </li><li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">2018 оны 12 сар | Төсөв санхүү</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">2018 оны 12 сар | Төсөв санхүү</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">2018 оны 12 сар | Төсөв санхүү</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">2018 оны 12 сар | Төсөв санхүү</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">2018 оны 12 сар | Төсөв санхүү</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">2018 оны 12 сар | Төсөв санхүү</span>
                            </li>

                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="background: #fafafa; border-top: 1px solid #f5f5f5;">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="head row background-white"><span>Аймгийн мэдээ</span></h3>
                    <ul class="row latest_news background-white">
                        @foreach($province_news as $nws)
                            @if($nws->type == 0)
                                <li class="col-sm-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="thumb" style="background-image: url('{{asset(str_replace("images","uploads/small/",$nws->image))}}');" title="{{$nws->title}}"></div>
                                        </div>
                                        <div class="col-7">
                                            @foreach($info->subDomain as $domain)
                                                @if($domain->id == 0)
                                            <a href="http://{{$domain->domain.'/!#/news/'.$nws->id}}" target="_blank">
                                                <h6>{{mb_substr($nws->title, 0, 55)}}...</h6></a>
                                                @endif
                                            @endforeach
                                            <span class="create_date"><i class="far fa-clock"></i> {{$nws->created_at->format('Y-m-d')}}</span>
                                        </div>
                                    </div>
                                </li>
                            @elseif($nws->type == 1)
                            <li class="col-sm-6">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="thumb photo" style="background-image: url('{{asset(str_replace("images","uploads/small/",$nws->image))}}');" title="{{$nws->title}}">
                                            <i class="far fa-images"></i>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        @foreach($info->subDomain as $domain)
                                            @if($domain->id == 0)
                                                <a href="http://{{$domain->domain.'/!#/news/'.$nws->id}}" target="_blank">
                                                    <h6>{{mb_substr($nws->title, 0, 55)}}...</h6></a>
                                            @endif
                                        @endforeach
                                        <span class="create_date"><i class="far fa-clock"></i> {{$nws->created_at->format('Y-m-d')}}</span>
                                    </div>
                                </div>
                            </li>
                            @elseif($nws->type == 2)
                                <li class="col-sm-6">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="thumb video" style="background-image: url('https://i.ytimg.com/vi/{{$nws->image}}/mqdefault.jpg');" title="{{$nws->title}}"><i class="fa fa-play"></i></div>
                                        </div>
                                        <div class="col-7">
                                            @foreach($info->subDomain as $domain)
                                                @if($domain->id == 0)
                                                    <a href="http://{{$domain->domain.'/!#/news/'.$nws->id}}" target="_blank">
                                                        <h6>{{mb_substr($nws->title, 0, 55)}}...</h6></a>
                                                @endif
                                            @endforeach
                                            <span class="create_date"><i class="far fa-clock"></i> {{$nws->created_at->format('Y-m-d')}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h3 class="head row background-white"><span>ЭВЭНТ</span></h3>
                    <ul class="row iltod_news background-white">
                        <div class="iltod_scroll scrollbar-inner">
                            {{--@foreach($tender_posts as $tend)
                                @foreach($latest_news as $nws)
                                    @if($tend->post_id == $nws->id)
                                    <li>
                                        <a href="{{asset('news/'.$nws->id)}}">{{mb_substr($nws->title, 0, 55)}}...</a>
                                        <span class="create_date">Нийтэлсэн: {{$nws->created_at->format('Y-m-d')}}</span>
                                    </li>
                                    @endif
                                @endforeach
                            @endforeach--}}
                            <li>
                                <a href="#">Морин хуурын чуулгын дөрвөл хөгжимчдийн тоглолт</a>
                                <span class="create_date"><font color="black">Хаана:</font> Сумын соёлын төвд   |   <font color="black">Хэзээ:</font> 2019-05-10 19:00 цагт </span>
                            </li>
                            <li>
                                <a href="#">Морин хуурын чуулгын дөрвөл хөгжимчдийн тоглолт</a>
                                <span class="create_date"><font color="black">Хаана:</font> Сумын соёлын төвд   |   <font color="black">Хэзээ:</font> 2019-05-10 19:00 цагт </span>
                            </li>
                            <li>
                                <a href="#">Морин хуурын чуулгын дөрвөл хөгжимчдийн тоглолт</a>
                                <span class="create_date"><font color="black">Хаана:</font> Сумын соёлын төвд   |   <font color="black">Хэзээ:</font> 2019-05-10 19:00 цагт </span>
                            </li>
                            <li>
                                <a href="#">Морин хуурын чуулгын дөрвөл хөгжимчдийн тоглолт</a>
                                <span class="create_date"><font color="black">Хаана:</font> Сумын соёлын төвд   |   <font color="black">Хэзээ:</font> 2019-05-10 19:00 цагт </span>
                            </li>
                            <li>
                                <a href="#">Морин хуурын чуулгын дөрвөл хөгжимчдийн тоглолт</a>
                                <span class="create_date"><font color="black">Хаана:</font> Сумын соёлын төвд   |   <font color="black">Хэзээ:</font> 2019-05-10 19:00 цагт </span>
                            </li>
                            <li>
                                <a href="#">Морин хуурын чуулгын дөрвөл хөгжимчдийн тоглолт</a>
                                <span class="create_date"><font color="black">Хаана:</font> Сумын соёлын төвд   |   <font color="black">Хэзээ:</font> 2019-05-10 19:00 цагт </span>
                            </li>
                            <li>
                                <a href="#">Морин хуурын чуулгын дөрвөл хөгжимчдийн тоглолт</a>
                                <span class="create_date"><font color="black">Хаана:</font> Сумын соёлын төвд   |   <font color="black">Хэзээ:</font> 2019-05-10 19:00 цагт </span>
                            </li>
                            <li>
                                <a href="#">Морин хуурын чуулгын дөрвөл хөгжимчдийн тоглолт</a>
                                <span class="create_date"><font color="black">Хаана:</font> Сумын соёлын төвд   |   <font color="black">Хэзээ:</font> 2019-05-10 19:00 цагт </span>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
