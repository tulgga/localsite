<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
    <link rel="apple-touch-icon-precomposed" href="{{ asset('uploads/'.$site->favicon)}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('uploads/'.$site->favicon) }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('uploads/'.$site->favicon) }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('uploads/'.$site->favicon) }}">
    <link rel="shortcut icon" href="{{ asset('uploads/'.$site->favicon) }}">

	<!-- Author Meta -->
	<meta name="author" content="">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Төрийн үйлчилгээ</title>

	<link href="{{ asset('main/sub/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/bootstrap-grid.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/scroll.style.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <script src="{{ asset('main/sub/js/jquery-2.1.1.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('main/sub/js/jquery.scrollbar.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <link href="{{ asset('/main/service/service.css') }}" rel="stylesheet" type="text/css">
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
                <h3 class="mb-20" style="font-size: 15px; text-align: -webkit-center">
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
                                    <div class="col-md-6">
                                        <div class="single-feature">
                                                <img src="{{ $row->image ? asset('uploads/'.$row->image) : '/images/image.png' }}" alt="" style="width: 50%;">
                                            <div class="desc text-center">
                                                <a href="{{asset('/'.$row->id)}}" style="color: #1c3658;">

                                                <button class="primary-btn hover d-inline-flex align-items-center"
                                                        style="width: 100%;color: #1c3658; text-align: left; font-size: 10px;">
                                                    <span class="mr-10" style="font-size: 10px"
                                                    >{{$row->title}}</span>
                                                        <span class="lnr lnr-arrow-right" style="position: absolute; right: 10px; top:12px;"></span>
                                                </button>
                                                </a>
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
                        <div class="desc" style="margin-top:0px">
                            <h6 class="title text-uppercase">Хаяг</h6>
                            <p>{{$conf['contact']['address']}}</p>
                        </div>
                    </div>
                    <div class="single-widget d-flex flex-wrap justify-content-between">
                        <div class="desc">
                            <h6 class="title text-uppercase">Утасны дугаар</h6>
                            <div class="contact">
                                <?php $phones = $pieces = explode(", ", $conf['contact']['phone']);?>
                                @foreach($phones as $phone)
                                    <a href="tel:{{$phone}}">{{$phone}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="single-widget d-flex flex-wrap justify-content-between">
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
                                <i class="fab fa-facebook"></i>
                            </a>
                        @endif

                        @if(!is_null($conf['socail']['twitter']))
                            <a href="{{$conf['socail']['twitter']}}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif

                        @if(!is_null($conf['socail']['youtube']))
                            <a href="{{$conf['socail']['youtube']}}" target="_blank">
                                <i class="fab fa-youtube"></i>
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

</body>
</html>
