@extends('zar.body')
@section('meta')
    <title></title>
    <meta name="title" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
@endsection
@section('content')

    <div class="input-layout1 gradient-padding post-ad-page">
        <form id="post-add-form" method="post">
            <div class="border-bottom-2 mb-50 pb-30">
                <div class="section-title-left-dark border-bottom d-flex">
                    <h3><img src="{{url('main/zar/img/post-add3.png')}}" alt="post-add" class="img-fluid"> Зар нэмэх</h3>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label">Ангилал<span> *</span></label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <div class="custom-select" >
                                <select id="category-name" class='select2' required>
                                    <option value="">Ангилал сонгох</option>
                                    <option value="1">Electronics</option>
                                    <option value="2">Fashin &amp; Life Style</option>
                                    <option value="3">Car &amp; Vehicles</option>
                                    <option value="3">Hobby, Sport &amp; Kids</option>
                                    <option value="3">Pets &amp; Animals</option>
                                    <option value="3">Overseas Jobs</option>
                                    <option value="3">Property</option>
                                    <option value="3">Education</option>
                                    <option value="3">Home &amp; Garden</option>
                                    <option value="3">Business &amp; Industry</option>
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
                            <input type="text" id="add-title" class="form-control" required >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 col-12">
                        <label class="control-label">Зар<span> *</span></label>
                    </div>
                    <div class="col-sm-9 col-12">
                        <div class="form-group">
                            <textarea class="textarea form-control" name="message" id="description" rows="4" cols="20" data-error="Message field is required" required=""></textarea>
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
                        <label class="control-label">И-мэйл хаяг <span></span></label>
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
                                    <input type="file" name="image[]" class="form-control">
                                </li>
                                <li>
                                    <input type="file" name="image[]" class="form-control">
                                </li>
                                <li>
                                    <input type="file" name="image[]" class="form-control">
                                </li>
                                <li>
                                    <input type="file" name="image[]" class="form-control">
                                </li>
                                <li>
                                    <input type="file" name="image[]" class="form-control">
                                </li>
                                <li>
                                    <input type="file" name="image[]" class="form-control">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-20">
                <button type="submit" class="cp-default-btn-sm">Нэмэх</button>
            </div>

        </form>
    </div>
@endsection