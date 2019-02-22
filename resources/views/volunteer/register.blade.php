@extends('volunteer.body')
@section('meta')
    <title>Бүртгүүлэх</title>
    <meta name="title" content="Volunteer | Сайн дурынхан">
    <meta name="keywords" content="Volunteer | Сайн дурынхан">
    <meta name="description" content="Volunteer | Сайн дурынхан">
@endsection
@section('content')
<div class="container pt-5 pb-5">
    @if(Session::has('successMsg'))
        <div class="alert alert-success"> {{ Session::get('successMsg') }} <a href="{{asset('login') }}">Нэвтрэх</a> </div>
    @endif
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <h3 class="head text-center mb-4">Бүртгэлийн <strong>хэсэг</strong></h3>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="text-uppercase nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Хувь хүн</a>
                </li>
                <li class="nav-item">
                    <a class="text-uppercase nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Байгууллага</a>
                </li>
            </ul>
            <div class="tab-content bg-white rounded-bottom" id="myTabContent" style="border-top-left-radius: 0 !important;;">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form method="post" action="{{asset("userRegister")}}" class="registerForum">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>И-мэйл хаяг:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Утасны дугаар:</label>
                            <input type="number" name="cellPhone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Нууц үг:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Бүртгүүлэх</button>
                        <div class="registerOr"><span>эсвэл</span></div>
                        <button type="button" class="facebookBTN"><i class="fab fa-facebook-square"></i> Фэйсбүүк</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <form method="post" action="{{asset("organizationRegister")}}" class="registerForum">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>И-мэйл хаяг:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Утасны дугаар:</label>
                            <input type="number" name="cellPhone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Нууц үг:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Бүртгүүлэх</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
@endsection