@extends('sub.layouts.site')
@section('meta')
        <title>{{$page->title}}</title>
        <meta name="title" content="{{$page->title}}">
        <meta name="description" content="{{mb_substr(strip_tags($page->text), 0, 250)}}">
        <meta name="keywords" content="{{$page->title}}">

        <meta name="twitter:title" content="{{$page->title}}">
        <meta name="twitter:description" content="{{mb_substr(strip_tags($page->text), 0, 250)}}">
        <meta name="twitter:url" content="{{asset('news/'.$page->id)}}">
        <meta name="twitter:image" content="{{asset('uploads/'.$page->image)}}">

        <meta property="og:title" content="{{$page->title}}">
        <meta property="og:description" content="{{mb_substr(strip_tags($page->text), 0, 250)}}">
        <meta property="og:image" content="{{asset('uploads/'.$page->image)}}">
@endsection
@section('content')
    <div class="row" style="background: #262b49;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('')}}">Нүүр хуудас</a><hex></hex></li>
                    <li class="breadcrumb-item"><a href="#">Library</a><hex></hex></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
                <div class="back-history"><a href="javascript:history.back(-1)">Өмнөх хуудас руу буцах</a></div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-9">
                    @if($page->type == 0)
                        @component('sub.pageTemplates.page-content', ['page'=>$page]) @endcomponent
                    @elseif($page->type == 2)
                        @component('sub.pageTemplates.page-posts',  ['page'=>$page,'newslist'=>$newslist]) @endcomponent
                    @endif
                </div>
                <div class="col-sm-3">
                    <h3 class="head row"><span>Ил тод байдал</span></h3>
                    <ul class="left-side-menu">
                        <li>
                            <a href="http://bayanovoo.khongor.gov.mn/menu_all/170">Төсөв санхүү</a>
                            <ul>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/174">Төсөв</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/175">Төсвийн гүйцэтгэл,сарын мэдээ</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/176">Аудитын дүгнэлт,зөвлөмж</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/177">5 сая + орлого,зарлага</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/178">Орон нутгийн хөгжлийн сан</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/179">Орон нутгийн нөөц хөрөнгө</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/180">Сум хөгжүүлэх сан</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://bayanovoo.khongor.gov.mn/menu_all/171">Хүний нөөц</a>
                            <ul>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/181">Сул орон тоо</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/182">Сонгон шалгаруулалт</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/183">Мэдээ тайлан</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://bayanovoo.khongor.gov.mn/menu_all/172">Худалдан авах ажиллагаа</a>
                            <ul>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/184">Тендер</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/185">Тайлан мэдээ</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="http://bayanovoo.khongor.gov.mn/menu_all/173">Үйл ажиллагаа</a>
                            <ul>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/186">Авилгын эсрэг үйл ажиллагааны төлөвлөгөө,тайлан</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/187">Тусгай зөвшөөрөл</a>
                                </li>
                                <li>
                                    <a href="http://bayanovoo.khongor.gov.mn/menu_all/188">Үйлчилгээний төлбөр хураамж</a>
                                </li>
                            </ul>
                        </li>
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