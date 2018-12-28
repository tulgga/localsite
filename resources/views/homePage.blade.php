<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/x-icon" href="{{$favicon}}"/>
    <title>{{$config['meta']['title']}}</title>
    <meta name="keywords" content="{{$config['meta']['keywords']}}">
    <meta name="description" content="{{$config['meta']['title']}}">

    <meta property="og:title" content="{{$config['meta']['title']}}">
    <meta property="og:image" content="{{$favicon}}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:description" content="{{$config['meta']['description']}}">
    <!-- Styles -->
    {{$mainConfig['google_analytics']}}
    <link href="{{ asset('main/sub/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/bootstrap-grid.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('style/css/customs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('style/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <!-- Javascript -->
    <script src="{{ asset('main/sub/js/jquery-2.1.1.min.js')}}" type="text/javascript"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body style="padding: 0 10px">
<div class="row">
    <div class="container text-center">
        <div class="logo"><img src="style/images/index-logo.png"></div>
        <div class="row">
            <ul class="col-sm-6 left-menu">
                <li><a href="!"><i class="fa fa-home"></i> Үндсэн веб хуудас</a></li>
                <li><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-folder-o"></i> Лавлагаа мэдээлэл</a></li>
                <li><a href="http://shilendans.gov.mn/org/36" target="_blank"><i class="fa fa-cube"></i> Шилэн дансны мэдээлэл</a></li>
            </ul>
            <ul class="col-sm-6 right-menu">
                <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-list-ul"></i> Сумдын веб хуудас</a></li>
                <li><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-2"><i class="fa fa-sitemap"></i> Агентлагуудын холбоос</a></li>
                <li><a href="http://bayankhongor.towersoft.mn/!#/report"><i class="fa fa-lightbulb-o"></i> Санал хүсэлт, өргөдөл гомдол</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <a href="{{$domain->domain}}">@if($domain->favicon)<img src="{{ asset('uploads/'.$domain->favicon)}}">@else<img src="{{ asset('uploads/favicon/XnjMhMUg3enV21GhLYDopC2L6uHsuQK0BqjTjCjP.png')}}">@endif {{$domain->name}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content sumd">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Лавлагаа мэдээллийн цонх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="accordionExample">
                    @php $services = json_decode($service, TRUE); @endphp
                    @foreach($services as $i=>$srvc)
                    <div class="card">
                        <div class="card-header" id="heading_{{$i}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_{{$i}}" aria-expanded="false" aria-controls="collapse_{{$i}}">
                                    {{$srvc['title']}}
                                </button>
                            </h2>
                        </div>
                        <div id="collapse_{{$i}}" class="collapse" aria-labelledby="heading_{{$i}}" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="accordion" id="accordionExample1">
                                    @foreach($srvc['item'] as $i=>$item)
                                    <div class="card">
                                        <div class="card-header" id="item_{{$i}}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#item1_{{$i}}" aria-expanded="false" aria-controls="item1_{{$i}}">
                                                    {{$item['title']}}
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="item1_{{$i}}" class="collapse" aria-labelledby="item_{{$i}}" data-parent="#accordionExample1">
                                            <div class="card-body">
                                            @if(isset($item['item']))
                                            <div class="accordion" id="accordionExample2">
                                                @foreach($item['item'] as $i=>$itm)
                                                    <div class="card">
                                                        <div class="card-header" id="itm_{{$i}}">
                                                            <h2 class="mb-0">
                                                                <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#itm1_{{$i}}" aria-expanded="false" aria-controls="itm1_{{$i}}">
                                                                    {{$itm['title']}}
                                                                </button>
                                                            </h2>
                                                        </div>
                                                        <div id="itm1_{{$i}}" class="collapse" aria-labelledby="itm_{{$i}}" data-parent="#accordionExample2">
                                                            <div class="card-body">
                                                                <ol style="list-style: inside decimal-leading-zero;">
                                                                    <li>Хэрэгтэй мэдээлэл болон бүрдүүлэх материалын жагсаалт орно...</li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                @endforeach
                                                </div>
                                            
                                            @else
                                                <ol style="list-style: inside decimal-leading-zero;">
                                                   <li>Хэрэгтэй мэдээлэл болон бүрдүүлэх материалын жагсаалт орно...</li>
                                                </ol>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                             </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content sumd">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Аймгийн хэлтэс агентлагууд</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="row">
                        <li class="col-sm-6"> <a target="_blank" href="http://www.audit.mn/?page_id=1314">Аймгийн аудитийн газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Байгаль орчин, аялал жуулчлалын газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://www.bayankhongor.moh.gov.mn/emg/">Эрүүл мэндийн газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://bayankhongor.gov.mn/top/31">Орон нутгийн өмчийн газар </a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Хөгжимт драмын театр</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://www.ndaatgal.bkh.gov.mn">Нийгмийн даатгалын хэлтэс</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Стандарт, хэмжил зүйн хэлтэс</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://bkh.burtgel.gov.mn/">Улсын бүртгэлийн хэлтэс </a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Тагнуулын хэлтэс</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Шүүхийн шинжилгээний алба</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://www.bayankhongor.nema.gov.mn/">Онцгой байдлын газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Гэр бүл,хүүхэд, залуучуудын хөгжлийн газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://bayankhongor.gazar.gov.mn/">ГХБХБГазар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Хүүхдийн Тэмүүжин театр</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Хүнс, хөдөө аж ахуйн газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://www.bayankhongor.court.gov.mn/">Аймгийн шүүх</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Түүх угсаатны зүйн музей</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://www.bayankhongor.nso.mn/index.php">Статистикийн хэлтэс </a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://bayankhongor.gov.mn/116/single">Санхүүгийн хяналт, аудитын алба </a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Биеийн тамир, спортын газар </a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Гаалийн алба </a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="www">Номын сан</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://bkh.inspection.gov.mn/">Мэргэжлийн хяналтын газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://bayankhongor.halamj.gov.mn">Хөдөлмөр, халамжийн үйлчилгээний газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://www.bayankhongor.police.gov.mn">Цагдаагийн газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://bayankhongor.cd.gov.mn/">Шүүхийн шийдвэр гүйцэтгэх алба</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://bayankhongor-bolovsrol.mn">Боловсрол, соёл, урлагийн газар</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://mta-bayankhongor.mn/">Татварын хэлтэс</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://prokuror.bkh.gov.mn/ ">Аймгийн прокурор</a> </li>
                        <li class="col-sm-6"> <a target="_blank" href="http://bayankhongor.tsag-agaar.gov.mn/">Ус, цаг уур, орчны шинжилгээний газар</a> </li>
                      </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
