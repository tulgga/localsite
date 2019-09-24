@extends('sub.layouts.site')
@section('meta')
    <title>Able - Төрийн албан хаагчид</title>
    <meta name="title" content="Able - Төрийн албан хаагчид">
    <meta name="description" content="Able - Төрийн албан хаагчид">
    <meta name="keywords" content="Able - Төрийн албан хаагчид">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 workers">
            @foreach($ables as $i=>$able)
                @if($able['type'] == 0 || $able['type'] == 2)
                <h4>{{str_replace("1","",$able['name'])}}</h4>
                <div class="d-block">
                @if(isset($able['childrenSub']))
                @foreach($able['childrenSub'] as $users)
                        @if(isset($users['users']))
                        @foreach($users['users'] as $user)
                            <div class="profile_box">
                                <div class="profile">
                                    @if(!$user['photo'])
                                    <img class="w-100 d-block" src="/main/sub/images/no_profile.png">
                                    @else
                                    <profile style="background-image: url('{{$user['photo']}}')"></profile>
                                    @endif
                                </div>
                                <name>{{$user['system_name']}}</name>
                                <duty>{{$user['app_name']}}</duty>
                                <div class="contact">
                                    @if($user['work_mail']) <a href="mailto:{{$user['work_mail']}}" title="{{$user['work_mail']}}"><i class="fa fa-envelope"></i></a> @endif
                                    @if($user['work_phone']) <a href="tel:{{$user['work_phone']}}" title="{{$user['work_phone']}}"><i class="fa fa-phone"></i></a> @endif
                                </div>
                            </div>
                        @endforeach
                            @endif
                @endforeach
                @else
                    @if(isset($users['users']))
                        @foreach($users['users'] as $user)
                            <div class="profile_box">
                                <div class="profile">
                                    @if(!$user['photo'])
                                        <img class="w-100 d-block" src="/main/sub/images/no_profile.png">
                                    @else
                                        <profile style="background-image: url('{{$user['photo']}}')"></profile>
                                    @endif
                                </div>
                                <name>{{$user['system_name']}}</name>
                                <duty>{{$user['app_name']}}</duty>
                                <div class="contact">
                                    @if($user['work_mail']) <a href="mailto:{{$user['work_mail']}}" title="{{$user['work_mail']}}"><i class="fa fa-envelope"></i></a> @endif
                                    @if($user['work_phone']) <a href="tel:{{$user['work_phone']}}" title="{{$user['work_phone']}}"><i class="fa fa-phone"></i></a> @endif
                                </div>
                            </div>
                        @endforeach
                     @endif
                @endif
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('profile').height($('.profile').width());
    })
</script>
@endsection
