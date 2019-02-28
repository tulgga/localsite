@extends('zar.body')
@section('meta')
    <title></title>
    <meta name="title" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
@endsection
@section('content')
    <div class="gradient-title">
        <div class="row">
            <div class="col-6">
                <h2>Ангилал: {{$selected_cat->name}}</h2>
            </div>
            <div class="col-6">
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
            @foreach($zar as $z)
                <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-12">
                    <div class="product-box item-mb zoom-gallery">
                        <div class="item-mask-wrapper">
                            <div class="item-mask secondary-bg-box"><img src="{{url('uploads/'.$z->image)}}" alt="categories" class="img-fluid">
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
                                <li class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>{{$z->created_at->format('Y-m-d H:i')}}</li>
                                <li class="tag-ctg"><i class="fa fa-tag" aria-hidden="true"></i>{{$z->category}}</li>
                            </ul>
                            <p>{{mb_substr($z->content, 0,200)}}...</p>
                            <div class="price">{{$z->price}} ₮</div>
                            <a href="{{url('p/'.$z->id.'.html')}}" class="product-details-btn">Цааш нь</a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $zar->links() }}
        </div>
    </div>
@endsection