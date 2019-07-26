@extends('volunteer.body')
@section('meta')
    <title>Хувийн мэдээлэл</title>
    <meta name="title" content="Хувийн мэдээлэл">
    <meta name="keywords" content="Хувийн мэдээлэл">
    <meta name="description" content="Хувийн мэдээлэл">
    <script src="{{asset('main/volunteer')}}/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        var $base_url = '{{asset('')}}';
    </script>
    <script src="{{asset('main/volunteer')}}/js/init_editor.js"></script>
@endsection
@section('content')
<div class="container mt-5 mb-5 bg-white p-4">
    <div class="row">
        <div class="col-sm-12">
            <h6>Шинэ мэдээлэл нэмэх</h6>
            <hr/>
            @if(Session::has('successMsg'))
                <div class="alert alert-success font-14"><i class="fa fa-check"></i> {{ Session::get('successMsg') }} </div>
            @elseif(Session::has('errorMsg'))
                <div class="alert alert-danger font-14"><i class="fa fa-check"></i> {{ Session::get('errorMsg') }} </div>
            @endif
            <form class="font-14" method="post" action="{{asset('saveEvent')}}" enctype="multipart/form-data">
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="subject">Гарчиг:</label>
                                    <input value="{{$subject}}" type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="subject">Зураг:</label>
                                    <input class="w-100" type="file"  name="images[]" @if($id == 0) required @endif multiple>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="subject">Эхлэх огноо:</label>
                                    <input value="{{$started}}" type="date" class="form-control" id="started" name="started" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="subject">Дуусах огноо:</label>
                                    <input value="{{$ended}}" type="date" class="form-control" id="ended" name="ended" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                @if($images)
                                <div class="form-group">
                                    <label>Оруулсан зурагнууд: </label>
                                        @foreach($images as $img)
                                            <div class="eventImg" style="background-image: url({{asset('uploads')}}/{{$img->image}})">
                                                <a class="btn btn-sm btn-danger font-12 d-table" href="/deleteImg/{{$img->id}}/{{$id}}"><i class="fa fa-trash"></i></a>
                                            </div>
                                        @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="subject">Оролцсон хүмүүс тэмдэглэх:</label>
                                        <input type="text" id="searchPeople" class="form-control"/>
                                        <div class="resultPeople">
                                            <ul class="rePeoslist"></ul>
                                        </div>
                                    </div>
                                @if($users == "" || $users == "[]")
                                    <div class="form-group tages" style="display: none;"></div>
                                @else
                                <div class="form-group tages">
                                    @foreach($users as $usr)
                                        @if($usr->user_id == 0)
                                            <span class="tag u_{{$usr->id}}">{{$usr->description}} <i class="fa fa-times" onclick="deleteUser({{$usr->id}}); return false;"></i></span>
                                        @else
                                            <span class="tag u_{{$usr->id}}">{{$usr->firstname.' '.$usr->lastname}} <i class="fa fa-times" onclick="deleteUser({{$usr->id}}); return false;"></i></span>
                                        @endif
                                    @endforeach
                                </div>
                                @endif
                                <div id="inputVal"></div>
                            </div>
                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="subject">Оролцсон байгууллага тэмдэглэх:</label>
                                        <input type="text" id="searchOrg" class="form-control">
                                        <div class="resultOrg">
                                            <ul class="reOrgslist"></ul>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pagetext">Тайлбар:</label>
                            <textarea name="contentHTML" id="pagetext" rows="10">{{$content}}</textarea>
                        </div>

                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-12">
                        <a class="btn btn-sm btn-light" href="{{asset('events')}}">Буцах</a>
                        <input type="hidden" name="id" value="{{$id}}">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Хадгалах</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    deleteUser = function (idc){
        var formData = {
            _token: $("#_token").val(),
            id: idc
        };
        $.ajax({
            type:'POST',
            url:'/usrDeleteFromEvent',
            data: formData,
            success:function(data) {
                $("#_token").val(data._token);
                    if(data.success == "true"){
                        $(".u_"+idc).remove();
                    }else{
                        alert("Алдаа гарлаа! Дахин ачаалуулна уу.");
                    }
                }
            });
    };
    runDel = function(){
        $(".tag i").click(function() {
            $("."+$(this).attr('id')).remove();
            $("#input-"+$(this).attr('id')).remove();
            if($(".tages").text() == ""){
                $(".tages").hide();
            }
        });
    };
    $("#searchPeople").keypress(function () {
        $(".rePeoslist").html("");
        var formData = {
            _token: $("#_token").val(),
            likeValue: $("#searchPeople").val()
        };
        $.ajax({
            type:'POST',
            url:'/searchPeople',
            data: formData,
            success:function(data){
                if(data.success == "true"){
                    $("#_token").val(data._token);
                    $(".rePeoslist").show();
                    if(data.data == ""){
                        $(".rePeoslist").html('<li><a href="javascript:newAdd();">Нэмэх</a></li>');
                    }else{
                    $.each(data.data, function(index,value){
                        $(".rePeoslist").append('<li data-value="'+value.id+'" data-title="'+value.firstname+'">'+value.firstname+' <span class="email">'+value.email+'</span></li>');
                    });
                    findAdd();
                    }
                }
            }
        });
    });
    findAdd = function(){
        $(".rePeoslist li").click(function() {
            var rando = Math.floor((Math.random() * 1000) + 1);
            $(".tages").show();
            $(".tages").append('<span class="tag ' + rando + '">' + $(this).attr('data-title') + ' <i class="fa fa-times" id="' + rando + '"></i></span>');
            $("#inputVal").append('<input id="input-'+rando+'" type="hidden" name="user[]" value="'+$(this).attr('data-value')+'">');
            $("#searchPeople").val("");
            runDel();
            $(".rePeoslist").html("");
            $(".rePeoslist").hide();
        });
    };
    newAdd = function () {
        var rando = Math.floor((Math.random() * 1000) + 1);
        $(".tages").show();
        $(".tages").append('<span class="tag '+rando+'">'+$("#searchPeople").val()+' <i class="fa fa-times" id="'+rando+'"></i></span>');
        $("#inputVal").append('<input id="input-'+rando+'" type="hidden" name="nouser[]" value="'+$("#searchPeople").val()+'">');
        $("#searchPeople").val("");
        runDel();
        $(".rePeoslist").html("");
        $(".rePeoslist").hide();
    };
</script>
@endsection
