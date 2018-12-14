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
                    <?php $i=1; ?>
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
                     <?php $i++; ?>
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
                <a href="#"><i class="fa fa-gavel"></i> Иргэдийн төлөөлөгчдийн<br>хурлын тогтоол</a>
                <a href="#"><i class="far fa-file-alt"></i> Засаг даргын<br>захирамж</a>
                <a href="#"><i class="far fa-list-alt"></i> Засаг даргын тамгын<br>газрын тушаал</a>
                <a href="#"><i class="fa fa-university"></i> Төсөл<br>хөтөлбөрүүд</a>
                <a href="#"><i class="far fa-comments"></i> Санал хүсэлт<br>өргөдөл, гомдол</a>
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
                        <li class="col-sm-6">
                            <div class="row">
                                <div class="col-5">
                                    <div class="thumb" style="background-image: url('{{asset(str_replace("images","uploads/small/",$nws->image))}}');" title="{{$nws->title}}"></div>
                                </div>
                                <div class="col-7">
                                    <a href="#"><h6>{{mb_substr($nws->title, 0, 55)}}...</h6></a>
                                    <span class="create_date"><i class="far fa-clock"></i> {{$nws->created_at}}</span>
                                </div>
                            </div>
                        </li>
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
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <pre>{{json_encode($province_news)}}</pre>
    <div class="row" style="background: #fafafa; border-top: 1px solid #f5f5f5;">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="head row background-white"><span>Аймгийн мэдээ</span></h3>
                    <ul class="row latest_news background-white">
                        @foreach($province_news as $nws)
                            @if($nws->type == 1)
                            <li class="col-sm-6">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="thumb" style="background-image: url('{{asset(str_replace("images","uploads/small/",$nws->image))}}');" title="{{$nws->title}}"></div>
                                    </div>
                                    <div class="col-7">
                                        <a href="#"><h6>{{mb_substr($nws->title, 0, 55)}}...</h6></a>
                                        <span class="create_date"><i class="far fa-clock"></i> {{$nws->created_at}}</span>
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
                                            <a href="#"><h6>{{mb_substr($nws->title, 0, 55)}}...</h6></a>
                                            <span class="create_date"><i class="far fa-clock"></i> {{$nws->created_at}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-4">
                    <h3 class="head row background-white"><span>Тендерийн урилга</span></h3>
                    <ul class="row iltod_news background-white">
                        <div class="iltod_scroll scrollbar-inner">
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Авлигатай тэмцэх үндэснйий хөтөлбөр...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Авлигатай тэмцэх үндэснйий хөтөлбөр...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Авлигатай тэмцэх үндэснйий хөтөлбөр...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Авлигатай тэмцэх үндэснйий хөтөлбөр...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Авлигатай тэмцэх үндэснйий хөтөлбөр...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Авлигатай тэмцэх үндэснйий хөтөлбөр...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Авлигатай тэмцэх үндэснйий хөтөлбөр...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Аймгийн 2016 оны авлигын эсрэг, авлигаас урьдчилан сэргийлэх, соён...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                            <li>
                                <a href="#">Авлигатай тэмцэх үндэснйий хөтөлбөр...</a>
                                <span class="create_date">Зарлагдсан: 2018 оны 12 сар</span>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection