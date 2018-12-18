@extends('sub.layouts.site')
@section('meta')
    <title>{{$fileCategory->name}}</title>
    <meta name="title" content="{{$fileCategory->name}}">
    <meta name="description" content="{{$fileCategory->name}}">
    <meta name="keywords" content="{{$fileCategory->name}}">
@endsection
@section('content')
    <div class="row" style="background: #262b49;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('')}}">Нүүр хуудас</a><hex></hex></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Файлын сан</a><hex></hex></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$fileCategory->name}}</li>
                </ol>
                <div class="back-history"><a href="javascript:history.back(-1)">Өмнөх хуудас руу буцах</a></div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-9">
                    <div class="posts-blog row">
                        <table class="table table-bordered" style="font-size: 13px">
                            <thead>
                            <tr>
                                <th scope="col">А/Д</th>
                                <th scope="col">Файлын нэр</th>
                                <th scope="col">Батлагдсан огноо</th>
                                <th scope="col">Дагаж мөрдөх огноо</th>
                                <th style="text-align: center" scope="col">Хүчинтэй</th>
                                <th style="text-align: center" scope="col">Төрөл</th>
                                <th style="text-align: center" scope="col">Татах</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($filelist as $file)
                                <tr>
                                    <td>{{$file->cart_number}}</td>
                                    <td><a href="#">{{$file->name}}</a></td>
                                    <td>{{$file->publish_date}}</td>
                                    <td>{{$file->active_date}}</td>
                                    <td style="text-align: center">
                                        @if($file->status == 1)
                                            <i style="color:var(--success);" class="fa fa-check-circle"></i>
                                        @else
                                            <i style="color:var(--danger);" class="fa fa-minus-circle"></i>
                                        @endif
                                    </td>
                                    <td style="text-align: center"><span class="badge badge-secondary">
                                            <?php
                                                $type=explode('.', $file->file);
                                                echo $type[count($type)-1];
                                            ?>

                                        </span></td>
                                    <td style="text-align: center"><a href="{{asset('uploads/'.$file->file)}}" download><i class="fa fa-download"></i></a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h3 class="head row"><span>Файлын ангилал</span></h3>
                    <ul class="left-side-menu">
                        @php $i=1 @endphp
                        @foreach($fileCategories as $cat)
                            @if($cat->parent_id == 0)
                                <li @if($cat->id == $fileCategory->id)class="active"@endif>
                                    <a href="{{asset('files/'.$cat->id)}}">{{$cat->name}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="background: rgba(38, 43, 73, 0.03)">
        <div class="container holboos">
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Аймгийн засаг даргын тамгын газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын ерөнхийлөгчийн тамгын газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын засгийн газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын их хурал</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/avilga.png')}}"> Авлигатай тэмцэх газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/soyombo.png')}}"> Эрх зүйн мэдээллийн нэгдсэн сан</a>
        </div>
    </div>
@endsection