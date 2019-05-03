@extends('volunteer.body')
@section('meta')
    <title>Хувийн мэдээлэл</title>
    <meta name="title" content="Хувийн мэдээлэл">
    <meta name="keywords" content="Хувийн мэдээлэл">
    <meta name="description" content="Хувийн мэдээлэл">
@endsection
@section('content')
<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col-sm-9">
            @if(Session::has('successMsg'))
                <div class="alert alert-success font-14"><i class="fa fa-check"></i> {{ Session::get('successMsg') }} </div>
            @endif
            <form class="rounded font-14 p-4 bg-white" method="post" action="{{asset('profileUpdate')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="profile_pic">Зураг:</label>
                            <input type="file" class="w-100" name="profile_pic" id="profile_pic">
                        </div>
                    </div>
                    <div class="col-sm-3 text-right">
                        @if(Auth::user()->profile_pic)
                            <div class="profile_pic" style="width:65px;height:65px;background-image: url({{asset('uploads/'.Auth::user()->profile_pic)}}"></div>
                        @else
                        <img style="opacity: 0.5;border-radius: 50%" width="65" src="https://britz.mcmaster.ca/images/nouserimage.gif/image">
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="lastname">Овог:</label>
                            <input value="{{Auth::user()->lastname}}" type="text" class="form-control" name="lastname" id="lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Нэр:</label>
                            <input value="{{Auth::user()->firstname}}" type="text" class="form-control" name="firstname" id="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="registration_no">Регистрийн дугаар:</label>
                            <input value="{{Auth::user()->registration_no}}" pattern="[А-Яа-яӨөҮү]{2}[0-9]{8}" type="text" class="form-control" name="registration_no" id="registration_no" required>
                        </div>
                        <div class="form-group">
                            <label for="site_id">Харьяа сум:</label>
                            <select name="site_id" id="site_id" class="form-control" required>
                                <option value=""> Сум сонгох </option>
                                <?php foreach($site as $st){ ?>
                                <option value="<?php echo $st->id; ?>" @if(Auth::user()->site_id == $st->id) selected @endif><?php echo $st->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Нэвтрэх нэр:</label>
                            <input value="{{Auth::user()->name}}" type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">И-мэйл хаяг:</label>
                            <input value="{{Auth::user()->email}}" type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Утасны дугаар:</label>
                            <input value="{{Auth::user()->phone}}" type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-12">
                        <button name="submit" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Хадгалах</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
@endsection