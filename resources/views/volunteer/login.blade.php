@extends('volunteer.body')
@section('meta')
    <title>Нэвтрэх</title>
    <meta name="title" content="Volunteer | Сайн дурынхан">
    <meta name="keywords" content="Volunteer | Сайн дурынхан">
    <meta name="description" content="Volunteer | Сайн дурынхан">
@endsection
@section('content')
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form class="bg-white p-4 font-14 rounded" method="post" action="{{asset('loginUser')}}">
                    <div class="form-group">
                        <label>И-мэйл хаяг, утасны дугаар:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Нууц үг:</label>
                        <input type="text" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Нэвтрэх</button>
                    <div class="registerOr"><span>эсвэл</span></div>
                    <button type="button" class="facebookBTN"><i class="fab fa-facebook-square"></i> Фэйсбүүк</button>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
@endsection