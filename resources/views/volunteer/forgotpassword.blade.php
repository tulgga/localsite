@extends('volunteer.body')
@section('meta')
    <title>Нууц үг солих</title>
    <meta name="title" content="Volunteer | Сайн дурынхан">
    <meta name="keywords" content="Volunteer | Сайн дурынхан">
    <meta name="description" content="Volunteer | Сайн дурынхан">
@endsection
@section('content')
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form class="font-12 bg-white p-4 rounded" method="get" action="{{asset('forgotpassword')}}">
                    @if(Session::has('successMsg'))
                        <div class="alert alert-success font-14"> {{ Session::get('successMsg') }} <a href="{{asset('login') }}" data-toggle="modal" data-target="#LoginForm">Нэвтрэх</a></div>
                    @endif
                        @if(Session::has('errorMsg'))
                            <div class="alert alert-danger font-14"> {{ Session::get('errorMsg') }} </div>
                        @endif
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Бүртгэлтэй имэйл хаяг:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Нууц үг сэргээх</button>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
@endsection
