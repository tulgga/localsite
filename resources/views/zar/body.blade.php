<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('main/zar/img/favicon.png')}}">
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('main/zar/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('main/zar/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{ asset('main/zar/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('main/zar/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{ asset('main/zar/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('main/zar/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('main/zar/css/style.css')}}">
</head>
<body>
{{--<div id="preloader"></div>--}}
<div id="wrapper">
    <header>
        <div id="header-three" class="header-style1 header-fixed">

            <div class="main-menu-area" style="background-color: #224e8a" id="sticker">
                <div class="container">
                    <div class="row no-gutters d-flex align-items-center text-center text-md-left">
                        <div class="col-lg-3 col-md-3 ">
                            <div class="logo-area">
                                <a  href="{{url('/')}}" class="img-fluid">
                                    <img src="{{asset('main/zar/img/logo.png')}}" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 possition-static">
                            <form method="get" action="{{url('search.html')}}" class="searchform mb-3 mt-3 mb-md-0 mt-md-0">
                                <div class="row">
                                    <div class="col-md-3 col-5 pr-0">
                                        <select name="site_id" class="form-control">
                                            <option value="0">Бүх байршил</option>
                                            <?php if(isset($_GET['site_id'])){ $site_id=$_GET['site_id']; } else { $site_id=''; } ?>
                                            @foreach($sumd as $sum)
                                                <option value="{{$sum->id}}" @if($site_id == $sum->id) selected @endif>{{$sum->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-9 col-7 pl-0">
                                        <?php if(isset($_GET['s'])){ $s=$_GET['s']; } else { $s=''; } ?>
                                        <input type="text" name="s" value="{{$s}}" placeholder="Хайх утгаа оруулна уу...">
                                        <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2 col-md-2 text-center text-md-right">
                            <a href="{{url('post-ad.html')}}" class="cp-default-btn add-btn"><i class="fa fa-plus"></i> Зар нэмэх</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mt-sm-5 pt-5 pb-4">
        <div class="container">
            <img src="http://shuurhai.mn/uploads/banner/1552450152-60537911.gif" class="w-100">
            <ul class="row categories">
                <?php $cat=0; if(isset($selected_cat->id)){ $cat=$selected_cat->id;  }?>
                @foreach($category as $c)
                    <li class="col-sm-3"><a href="{{url('c/'.$c->id.'.html')}}" @if($cat==$c->id) class="active" @endif ><i class="fa fa-shopping-basket"></i> {{$c->name}}</a>
                    @if($c->children)
                         <ul class="children">
                        @foreach($c->children as $cc)
                            <li><a href="{{url('c/'.$cc->id.'.html')}}" @if($cat==$cc->id) class="active" @endif><i class="fa fa-angle-right"></i> {{$cc->name}}</a></li>
                        @endforeach
                         </ul>
                    @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <section class="pt-3 bg-accent-shadow-body">
        <div class="container pb-40">
            <div class="row">
                <div class="order-xl-2 col-lg-9 col-md-12 col-sm-12 col-12 mb--sm">
                    <div class="gradient-wrapper item-mb">
                        @yield('content')
                    </div>
                </div>
                <div class="order-xl-1 order-lg-1 col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                    <img class="w-100" src="http://www.shuurhai.mn/uploads/banners/jHotel.jpg">
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center">
        <div class="footer-area-top">
            <ul>
                <li><a href="{{env('APP_URL')}}"><i class="fa fa-home"></i> Үндсэн сайт</a></li>
                <li><a href="#"  data-toggle="modal" data-target="#sumModal"><i class="fa fa-list-ul"></i> Сумдууд</a></li>
                <li><a href="" data-toggle="modal" data-target="#agentlagModal"><i class="fa fa-sitemap"></i> Агентлагууд</a></li>
                <li><a href="{{env('APP_URL').'/!#/report'}}"><i class="fa fa-lightbulb-o"></i> Санал хүсэлт, өргөдөл гомдол</a></li>
            </ul>
        </div>
        <div class="footer-area-bottom">
           <p>Энэхүү цахим мэдээллийн нэгдсэн системийг "УХААЛАГ БАЯНХОНГОР" хөтөлбөрийн хүрээнд TАУЭРСОФТ ХХК бүтээв.</p>
        </div>
    </footer>
</div>

<div class="modal fade" id="sumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content sumd">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Сумдын холбоос</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="row">
                    @foreach($sumuud as $domain)
                        @if(!$domain->id == 0)
                            <li class="col-6">
                                <a href="http://{{$domain->domain}}.{{env('SUB_DOMAIN')}}">@if($domain->favicon)<img
                                            src="{{ asset('uploads/'.$domain->favicon)}}">@else<img
                                            src="{{ asset('uploads/favicon/XnjMhMUg3enV21GhLYDopC2L6uHsuQK0BqjTjCjP.png')}}">@endif {{$domain->name}}
                                </a>
                            </li>

                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-lg" id="agentlagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Aгантлаг холбоос</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  @foreach($agentlag as $a)
                      <div class="col-md-4 agentlaglist">
                          <a href="{{$a->link}}" target="_blank" ><img src="{{url('/images/soyombo.png')}}">{{$a->name}}</a>
                      </div>
                   @endforeach
              </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('main/zar/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('main/zar/js/popper.js') }}"></script>
<script src="{{ asset('main/zar/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('main/zar/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{ asset('main/zar/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('main/zar/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('main/zar/js/waypoints.min.js') }}"></script>
<script src="{{ asset('main/zar/js/select2.min.js') }}"></script>
<script src="{{ asset('main/zar/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('main/zar/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('main/zar/js/validator.min.js') }}"></script>
<script src="{{ asset('main/zar/js/main.js') }}"></script>

</body>
</html>
