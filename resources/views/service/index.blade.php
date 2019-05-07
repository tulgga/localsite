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
    <link href="{{ asset('/service/css/linearicons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/service/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/service/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/service/css/main.css') }}" rel="stylesheet" type="text/css">
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
                <div class="section-top-border">
                    <div class="row">
                        @foreach($data as $row)
                            <div class="col-md-4 mt-sm-30"; style="overflow: hidden">
                                <a href="{{asset('/'.$row->id)}}">
                                    <h3 class="mb-20">{{$row->title}}</h3>
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
                </div>

            @endif
        </div>
    </section>

    <section class="footer-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="single-widget d-flex flex-wrap justify-content-between" style="margin-top:0px">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-pushpin"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Хаяг</h6>
                            <p>56/8, panthapath, west <br> dhanmondi, kalabagan, <br>Dhaka - 1205</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="single-widget d-flex flex-wrap justify-content-between">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="lnr lnr-phone"></span>
                        </div>
                        <div class="desc">
                            <h6 class="title text-uppercase">Утасны дугаар</h6>
                            <div class="contact">
                                <a href="tel:1545">{{$conf['contact']['phone']}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
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
                        <a href="index.html"><img src="img/f-logo.png" alt=""></a>
                    </div>
                    <div class="copy-right-text">Copyright &copy; 2017  |  All rights reserved. This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></div>
                    <div class="footer-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </section>
</div>

<script src="{{ asset('/service/js/vendor/jquery-2.2.4.min.js') }}"></script>
</body>
</html>
