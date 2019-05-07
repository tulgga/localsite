<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Go Crepe</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link href="{{ asset('/main/service/css/linearicons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/main/service/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/main/service/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/main/service/css/main.css') }}" rel="stylesheet" type="text/css">
    </head>
<body>
<div class="main-wrapper-first">
    <section class="footer-widget-area" style="padding-top: 0px;">
        <div class="container">
            <div class="header-wrap">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{asset('/')}}">
                            <img src="{{ asset('uploads/'.$site->logo) }}" alt="">
                        </a>
                        <h1 class="header_title">
                            төрийн үйлчилгээ
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sample-text-area" style="padding-top: 20px;">
        <div class="container">
            @if($now!=null)
                <div class="row">
                    <div class="col-md-12">
                        <h3 >{{$now->title}}</h3>
                        <div class="row">
                        <div class="col-md-3">
                            <img src="{{ $now->image ? asset('uploads/'.$now->image) : '/images/image.png' }}" alt="" style="width: 100%;">
                        </div>
                        <div class="col-md-9"> {!! $now->text !!} </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-sm-12">
                @if(count($now_data)>0)
                    <div class="row">
                        @foreach($now_data as $row)
                            <div class="col-md-4">
                                <div class="single-feature">
                                    <a href="{{asset('/'.$row->id)}}">
                                        <img src="{{ $row->image ? asset('uploads/'.$row->image) : '/images/image.png' }}" alt="" style="width: 100px; height: 100px">
                                    </a>
                                    <div class="desc text-center">
                                        <a href="{{asset('/'.$row->id)}}">
                                            <h6 class="title text-uppercase">{{$row->title}}</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @if(count($data)>0)
                <div class="row">
                    @foreach($data as $row)
                        <div class="col-md-4 mt-sm-30"; style="overflow: hidden">
                            <a href="{{asset('/'.$row->id)}}">
                                <h4 class="mb-20">{{$row->title}}</h4>
                            </a>
                            @if(count($row->sub)>0)
                                <div class="">
                                    <ol class="ordered-list">
                                        @foreach($row->sub as $sub)
                                            <a href="{{asset('/'.$sub->id)}}">
                                                <li><span>{{$sub->title}}</span></li>
                                            </a>
                                        @endforeach
                                    </ol>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            @endif
        </div>
    </section>

    <section class="footer-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6";>
                    <h4 class="mb-20" style="color: #ffffff;">Сумд</h4>
                    <ul class="row">
                        @foreach($subDomain as $domain)
                            <a href="http://{{$domain->domain}}.{{env('SUB_DOMAIN')}}" target="_blank" class="col-sm-4">
                                <li style="color: #ffffff;">{{$domain->name}}</li>
                            </a>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4";>
                    <h4 class="mb-20" style="color: #ffffff;">Холбоо барих</h4>
                    <div class="single-widget d-flex flex-wrap justify-content-between" style="margin-top:0px">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-pushpin"></span>
                        </div>
                        <div class="desc" style="margin-top:0px">
                            <h6 class="title text-uppercase">Хаяг</h6>
                            <p>{{$conf['contact']['address']}}</p>
                        </div>
                    </div>
                    <div class="single-widget d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-phone"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Утасны дугаар</h6>
                            <div class="contact">
                                <?php $phones = $pieces = explode(", ", $conf['contact']['phone']);?>
                                @foreach($phones as $phone)
                                    <a href="tel:{{$phone}}">{{$phone}}</a><br/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="single-widget d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-earth"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Мэйл хаяг</h6>
                            <div class="contact">
                                <a href="mailto:info@dataarc.com">{{$conf['contact']['email']}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="footer-content d-flex justify-content-between align-items-center flex-wrap">
                    <div class="logo">
                        <a href="{{asset('/')}}">
                            <img src="{{ asset('uploads/'.$site->logo) }}" alt="" style="height: 40px" />
                        </a>
                    </div>
                    <div class="footer-social">
                        @if(!is_null($conf['socail']['facebook']))
                            <a href="{{$conf['socail']['facebook']}}" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        @endif

                        @if(!is_null($conf['socail']['twitter']))
                            <a href="{{$conf['socail']['twitter']}}" target="_blank">
                                <i class="fa fa-twitter"></i>
                            </a>
                        @endif

                        @if(!is_null($conf['socail']['youtube']))
                            <a href="{{$conf['socail']['youtube']}}" target="_blank">
                                <i class="fa fa-youtube"></i>
                            </a>
                        @endif

                    </div>
                    <div class="copy-right-text" style="text-align: center; width: 100%;">
                        <br/>
                        <br/>
                        Хуулбарлахыг хориглоно © 2018 Бүх эрх хуулиар хамгаалагдсан  <br/>
                        Энэхүү цахим мэдээллийн нэгдсэн системийг "УХААЛАГ БАЯНХОНГОР" хөтөлбөрийн хүрээнд <a href="https://towersoft.mn" target="_blank">TАУЭРСОФТ ХХК </a> бүтээв.
                    </div>
                </div>
            </div>
        </footer>
    </section>
</div>

<script src="{{ asset('/main/service/js/vendor/jquery-2.2.4.min.js') }}"></script>
</body>
</html>
