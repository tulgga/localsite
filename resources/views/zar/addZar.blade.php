@extends('zar.body')
@section('meta')
    <title></title>
    <meta name="title" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
@endsection
@section('content')

    <div class="input-layout1 gradient-padding post-ad-page">
        <form id="post-add-form" method="post" action="{{asset("postAdd")}}" enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="border-bottom-2 mb-50 pb-30">
                <div class="section-title-left-dark border-bottom d-flex">
                    <h3><img src="{{url('main/zar/img/post-add3.png')}}" alt="post-add" class="img-fluid"> Зар нэмэх</h3>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label">Хаана /сум/<span> *</span></label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <div class="custom-select" >
                                <select id="site-id" class="select2" name="site_id" required>
                                    <option value="">Сум сонгох</option>
                                    @foreach($sumd as $sum)
                                        <option value="{{$sum->id}}">{{$sum->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label">Ангилал<span> *</span></label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <div class="custom-select" >
                                <select id="category-name" class="select2" name="cat_id" required>
                                    <option value="">Ангилал сонгох</option>
                                    @foreach($category as $c)
                                        @if($c->children)
                                            <optgroup label="{{$c->name}}">
                                                @foreach($c->children as $cc)
                                                    <option value="{{$cc->id}}"> -- {{$cc->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @else
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label" for="add-title">Гарчиг <span> *</span></label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" required >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label">Зар<span> *</span></label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <textarea class="textarea form-control" name="content"  rows="4" cols="20" data-error="Message field is required" required=""></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label" >Үнэ <span> *</span></label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <input type="number" name="price"  class="form-control price-box" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label" >Утас <span> *</span></label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <input type="text"  name="phone"  class="form-control price-box" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label">Имэйл хаяг <span></span></label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <input type="email" name="email"  class="form-control price-box" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label" for="add-title">Зураг</label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <ul class="picture-upload">
                                <li>
                                    <input type="file" name="image_1" accept="image/*" >
                                </li>
                                <li>
                                    <input type="file" name="image_2" accept="image/*" >
                                </li>
                                <li>
                                    <input type="file" name="image_3" accept="image/*" >
                                </li>
                                <li>
                                    <input type="file" name="image_4" accept="image/*" >
                                </li>
                                <li>
                                    <input type="file" name="image_5" accept="image/*" >
                                </li>
                                <li>
                                    <input type="file" name="image_6" accept="image/*" >
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning">
                <strong><i class="fa fa-exclamation-triangle"></i> Санамж: </strong> Таны оруулсан зар 30 хоногийн дараа хаагдах болохыг анхаарна уу. Мөн мэдээлэл дутуу болон хууль бус зар оруулахгүй байхыг хүсье.
            </div>
            <div class="form-group mt-20">
                <button type="submit" class="cp-default-btn-sm">Нэмэх</button>
            </div>

        </form>
    </div>
@endsection
