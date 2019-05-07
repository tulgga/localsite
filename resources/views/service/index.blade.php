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
                            ТӨРИЙН ҮЙЛЧИЛГЭЭНИЙ <br/>
                            НЭГДСЭН ТӨВӨӨР <br/>ҮЗҮҮЛЖ БУЙ ҮЙЛЧИЛГЭЭ
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sample-text-area" style="padding-top: 20px;">
        <div class="container">
            <div class="col-md-12 mt-sm-30">
                <h3 class="mb-20" style="font-size: 15px;">
                    @if($now!=null &&  $now->id)
                        @foreach($main as $row)
                            <div class="btn-group">
                                <a href="{{asset('/'.$row->id)}}">
                                    <button type="button btn-sm" class="btn btn-secondary"
                                        style="font-size: 9px; margin-bottom:5px; background: {{($row->id==$now->id ) ? 'green' : ''}}" >
                                    {{$row->title}}
                                    </button>
                                </a>
                            </div>
                        @endforeach
                    @else
                        ТӨРИЙН ҮЙЛЧИЛГЭЭНИЙ НЭГДСЭН ТӨВӨӨР ҮЗҮҮЛЖ БУЙ ҮЙЛЧИЛГЭЭ
                    @endif
                </h3>
                <section class="featured-area" style="padding-top: 0px;">
                    <div class="container">
                        <div class="row">
                            @foreach($data as $row)
                                @if($row->parent_id==0)
                                    <div class="col-md-4">
                                        <div class="single-feature">
                                                <img src="{{ $row->image ? asset('uploads/'.$row->image) : '/images/image.png' }}" alt="" style="width: 50%;">
                                            <div class="desc text-center">
                                                <a href="{{asset('/'.$row->id)}}">

                                                <h6 class="title text-uppercase">{{$row->title}}</h6>
                                                </a>

                                                @if(count($row->sub)>0)
                                                    @foreach($row->sub as $sub)
                                                        <span style="margin-right: 5px;">{{$sub->title}}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="accordion col-sm-12" id="acc{{$row->id}}">
                                        <br/>
                                        <br/>
                                        <h3>{{$row->title}} ({{$row->is_organization==1 ? "хуулийн этгээд" : "иргэн" }})</h3>
                                        @foreach($row->sub as $i)
                                            <div class="card">
                                                <div class="card-header" id="head{{$row->id}}_{{$i->id}}">
                                                    <h5 class="mb-0" style="overflow: hidden">
                                                        <button class="btn btn-link"
                                                                type="button"
                                                                style="overflow: hidden"
                                                                data-toggle="collapse"
                                                                data-target="#collapse{{$row->id}}_{{$i->id}}"
                                                                aria-expanded="true"
                                                                aria-controls="collapse{{$row->id}}_{{$i->id}}">
                                                            {{$i->title}}
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div
                                                    id="collapse{{$row->id}}_{{$i->id}}"
                                                    class="collapse"
                                                    aria-labelledby="head{{$row->id}}_{{$i->id}}"
                                                    data-parent="#acc{{$row->id}}">
                                                    <div class="card-body">
                                                        {!! $i->text !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
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

<script src="{{ asset('/service/js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('/service/js/vendor/bootstrap.min.js') }}"></script>
</body>
</html>
