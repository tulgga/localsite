@extends('zar.body')
@section('meta')
    <title>Баянхонгор аймгийн зарын сайт</title>
    <meta name="title" content="Баянхонгор аймгийн зарын сайт">
    <meta name="keywords" content="Зарууд, Монгол,  зарын сайт, компьютерууд.Гар утас, орон сууц, хашаа байшин, хоноглох орон сууц, офисын байр, ажлын байрны орон тоо, Монгол дахь, тавилга, цахилгаан бараа, дэлгүүр, зарын самбар.">
    <meta name="description" content="Баянхонгор аймгийн зарын сайт">
    <meta property="og:locale" content="mn_MN">
    <meta property="og:locale:alternate" content="en_GB">
    <meta property="og:description" content="Баянхонгор аймгийн зарын сайт">
@endsection
@section('content')
    <div class="gradient-title">
        <div class="row">
            <div class="col-4">
                <h2>Бүх зар</h2>
            </div>
            <div class="col-8">
                <div class="layout-switcher">
                    <ul>
                        <li><a class="product-view-trigger" href="#" data-type="category-grid-layout3"><i class="fa fa-th-large"></i></a></li>
                        <li class="active"><a href="#" data-type="category-list-layout3" class="product-view-trigger"><i class="fa fa-list"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="category-view" class="category-list-layout3 gradient-padding zoom-gallery">
        <div class="row">
        @if($pinzar)
            @foreach($pinzar as $z)
                <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12 pin">
                    <div class="product-box item-mb zoom-gallery">
                        <div class="item-mask-wrapper" style="min-width: 180px;">
                            <div class="item-mask secondary-bg-box">
                                @if($z->image)
                                    <img src="{{url('uploads/'.$z->image)}}" alt="categories" class="img-fluid">
                                @else
                                    <img src="{{url('images/noImage.jpg')}}" alt="categories" class="img-fluid">
                                @endif
                                <ul class="info-link">
                                    <li><a href="{{url('uploads/'.$z->image)}}" class="elv-zoom" data-fancybox-group="gallery" title="{{$z->title}}"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                    <li><a href="{{url('s/'.$z->id)}}"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="item-content">
                            <h3 class="short-title"><a href="{{url('p/'.$z->id.'.html')}}">{{$z->title}}</a></h3>
                            <h3 class="long-title"><a href="{{url('p/'.$z->id.'.html')}}">{{$z->title}}</a></h3>
                            <ul class="upload-info">
                                @if($z->created_at->format('Y-m-d') == date('Y-m-d'))
                                    <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> Өнөөдөр, {{$z->created_at->format('H:i')}}</li>
                                @elseif($z->created_at->format('Y-m-d') == date('Y-m-d',strtotime("-1 days")))
                                    <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>Өчигдөр, {{$z->created_at->format('H:i')}}</li>
                                @else
                                    <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$z->created_at->format('Y-m-d H:i')}}</li>
                                @endif
                                <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i>{{$z->category}}</li>
                            </ul>
                            <p class="pr-sm-5">{{mb_substr($z->content, 0,200)}}...</p>
                            <div class="price" style="font-size: 24px;">{{$z->price}} ₮</div>
                            <a href="{{url('p/'.$z->id.'.html')}}" class="product-details-btn">Цааш нь</a>
                        </div>
                    </div>

                </div>
            @endforeach
        @endif
            @php $i=1; @endphp
            @foreach($zar as $z)
                @if($i==7)
                    <div class="col-sm-12">
                    <img src="http://shuurhai.mn/uploads/banner/1556548776-69945622.jpg" class="w-100 mb-4">
                    </div>
                @else
                <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12">
                    <div class="product-box item-mb zoom-gallery">
                        <div class="item-mask-wrapper">
                            <div class="item-mask secondary-bg-box">
                                @if($z->image)
                                <img src="{{url('uploads/'.$z->image)}}" alt="categories" class="img-fluid">
                                @else
                                    <img src="{{url('images/noImage.jpg')}}" alt="categories" class="img-fluid">
                                @endif
                                <ul class="info-link">
                                    <li><a href="{{url('uploads/'.$z->image)}}" class="elv-zoom" data-fancybox-group="gallery" title="{{$z->title}}"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a></li>
                                    <li><a href="{{url('s/'.$z->id)}}"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="item-content">
                            <h3 class="short-title"><a href="{{url('p/'.$z->id.'.html')}}">{{$z->title}}</a></h3>
                            <h3 class="long-title"><a href="{{url('p/'.$z->id.'.html')}}">{{$z->title}}</a></h3>
                            <ul class="upload-info">
                                @if($z->created_at->format('Y-m-d') == date('Y-m-d'))
                                    <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> Өнөөдөр, {{$z->created_at->format('H:i')}}</li>
                                @elseif($z->created_at->format('Y-m-d') == date('Y-m-d',strtotime("-1 days")))
                                    <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>Өчигдөр, {{$z->created_at->format('H:i')}}</li>
                                @else
                                    <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$z->created_at->format('Y-m-d H:i')}}</li>
                                @endif
                                <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i>{{$z->category}}</li>
                            </ul>
                            <p class="pr-sm-5">{{mb_substr($z->content, 0,200)}}...</p>
                            <div class="price">{{$z->price}} ₮</div>
                            <a href="{{url('p/'.$z->id.'.html')}}" class="product-details-btn">Цааш нь</a>
                        </div>
                    </div>
                </div>
                @endif
            @php $i++; @endphp
            @endforeach

            {{ $zar->links() }}
        </div>
    </div>
@endsection
