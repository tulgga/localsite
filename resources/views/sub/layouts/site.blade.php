<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('main/sub/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('main/sub/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('main/sub/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('main/sub/images/favicon.png') }}">
    <link rel="shortcut icon" href="{{ asset('main/sub/images/favicon.png') }}">
    @yield('meta')
    <link href="{{ asset('main/sub/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/bootstrap-grid.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/customs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/scroll.style.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <script src="{{ asset('main/sub/js/jquery-2.1.1.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('main/sub/js/jquery.scrollbar.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function(){
            $('.scrollbar-inner').scrollbar();
            $('.scrollbar-inner.iltod_scroll').css("height","360px");
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="row top-line">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <ul class="top-contact">
                        <li><a href="tel:+976 70001011"><i class="fa fa-phone"></i> +976 7000-1011</a></li>
                        <li><a href="mailto:contact@towersoft.mn"><i class="fa fa-envelope"></i> contact@towersoft.mn</a></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="top-menu">
                        <li><a href="#"><i class="fa fa-link"></i> Бусад сумдууд</a></li>
                        <li><a href="#"><i class="fa fa-archive"></i> Архив</a></li>
                        <li><a href="#"><i class="fa fa-paper-plane"></i> Холбоо барих</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row menu-line">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-9">
                    <img class="logo" width="100%" src="{{ asset('main/sub/images/logo.png') }}"></div>
                <div class="col-sm-9 col-3">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <?php foreach($info->menu as $mn){ ?>
                                <?php if($mn->children){ ?>
                                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $mn->name; ?></a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php foreach($mn->children as $child){ ?>
                                        <?php if($child->children){ ?>
                                            <li class="nav-item dropdown">
                                                <a class="dropdown-item" href="#"><?php echo $child->name; ?></a>
                                                <ul>
                                                    <?php foreach($child->children as $subchuld){ ?>
                                                    <li class="nav-item">
                                                        <a class="dropdown-item" href="#"><?php echo $subchuld->name; ?></a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php }else{ ?>
                                        <li class="nav-item">
                                            <a class="dropdown-item" href="#"><?php echo $child->name; ?></a>
                                        </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php }else{ ?>
                                    <li class="nav-item"><a class="nav-link" href="#"><?php echo $mn->name; ?></a></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <div class="row">
        <div class="container holboos">
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Аймгийн засаг даргын тамгын газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын ерөнхийлөгчийн тамгын газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын засгийн газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын их хурал</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/avilga.png')}}"> Авлигатай тэмцэх газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/soyombo.png')}}"> Эрх зүйн мэдээллийн нэгдсэн сан</a>
        </div>
    </div>
    <div class="row footer">
        <div class="container">
            <div class="row contact">
                <div class="col-sm-4">
                    <h4 class="row">Холбоо барих</h4>
                    <div class="intro-footer">
                        Одоогийн Баянхонгор аймгийн Баян-Овоо сум нь Сайн ноён хан аймгийн Дайчин Гүн вангийн хошуу нь Халхын Умард замын Дундад баруун этгээдийн хошуу юм.
                    </div>
                    <p><a href="https://www.google.com/maps/place/Bayan-Ovoo/@46.1798737,100.6766078,13z/data=!4m5!3m4!1s0x5de82b9fa35922cf:0x336e835dbda1e4ec!8m2!3d47.7855583!4d112.1169004" target="_blank"><i class="fa fa-map-marker-alt"></i> Монгол улс, Баянхонгор аймаг, Баян-овоо сум</a></p>
                    <p><a href="tel:+976 8870-0203" target="_top"><i class="fa fa-phone"></i> +976 8870-0203</a></p>
                    <p><a href="mailto:javza0203@yahoo.com" target="_top"><i class="far fa-envelope"></i> javza0203@yahoo.com</a></p>
                    <ul class="social ml-auto">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                    </ul>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <h4 class="row"> Санал хүсэлт, өргөдөл, гомдол</h4>
                    <div class="layout"><input class="form-feedback" type="text" placeholder="Таны нэр *"></div>
                    <div class="layout"><input class="form-feedback" type="text" placeholder="Таны утас *"></div>
                    <div class="layout"><input class="form-feedback" type="text" placeholder="Таны цахим шуудан"></div>
                    <div class="layout"><textarea class="form-feedback" placeholder="Зурвас бичих...*"></textarea></div>
                </div>
            </div>
            <div class="row copyright">
                <div class="col-sm-12 text-center">
                    <p>Зохиогчийн бүх эрх хуулиар хамгаалагдсан
                        © 2018  <strong>БАЯНХОНГОР АЙМАГ <?php echo $info->name; ?> СУМ</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="back-to-top" style="display: none;">
    <!-- back to top start -->
    <i class="fa fa-rocket"></i>
</div>
</body>
</html>

<pre><?Php echo json_encode($info); ?></pre>