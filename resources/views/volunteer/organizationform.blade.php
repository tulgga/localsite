@extends('volunteer.body')
@section('meta')
    <title>Хувийн мэдээлэл</title>
    <meta name="title" content="Хувийн мэдээлэл">
    <meta name="keywords" content="Хувийн мэдээлэл">
    <meta name="description" content="Хувийн мэдээлэл">
@endsection
@section('content')
<div class="container pt-5 pb-5">
    @if(Session::has('successMsg'))
        <div class="alert alert-success font-14"><i class="fa fa-check"></i> {{ Session::get('successMsg') }} </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <form class="rounded font-14 p-4 bg-white" method="post" action="{{asset('organizationUpdate')}}" enctype="multipart/form-data">
                <h6>Байгууллагын мэдээлэл</h6><hr/>
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="logo">Лого:</label>
                            <input type="file" class="w-100" name="logo" id="logo">
                        </div>
                    </div>
                    <div class="col-sm-3 text-right">
                        @if($logo)
                            <div class="profile_pic" style="width:65px;height:65px;background-image: url({{asset('uploads/'.$logo)}}"></div>
                        @else
                        <img style="opacity: 0.5;border-radius: 50%" width="65" src="https://britz.mcmaster.ca/images/nouserimage.gif/image">
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Байгууллагын нэр:</label>
                            <input value="{{$name}}" type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="bag">Баг:</label>
                            <input value="{{$bag}}" type="text" class="form-control" name="bag" id="bag" required>
                        </div>
                        <div class="form-group">
                            <label for="email">И-мэйл:</label>
                            <input value="{{$email}}" type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="web">Веб сайт:</label>
                            <input value="{{$web}}" type="text" class="form-control" name="web" id="web">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="site_id">Харьяа сум:</label>
                            <select name="sum" id="site_id" class="form-control" required>
                                <option value=""> Сум сонгох </option>
                                <?php foreach($site as $st){ ?>
                                <option value="<?php echo $st->id; ?>" @if($sum == $st->id) selected @endif><?php echo $st->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Хаяг:</label>
                            <input value="{{$address}}" type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="phone">Утасны дугаар:</label>
                            <input value="{{$phone}}" type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="social_link">Сошиал холбоос:</label>
                            <input value="{{$social_link}}" type="text" class="form-control" name="social_link" id="social_link">
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-12">
                        <a class="btn btn-sm btn-light" href="{{asset('organization')}}">Буцах</a>
                        <input type="hidden" name="id" value="{{$id}}">
                        <button name="submit" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Хадгалах</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
