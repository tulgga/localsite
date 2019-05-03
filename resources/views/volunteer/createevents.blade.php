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
                {{ csrf_field() }}
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
                                    <label for="subject">Гарчиг:</label>
                                    <input class="w-100" type="file" id="images" name="images[]" multiple>
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
                        @if($images)
                        <div class="form-group">
                            <label>Оруулсан зурагнууд:</label>
                                @foreach($images as $img)
                                    <div class="eventImg" style="background-image: url({{asset('uploads')}}/{{$img->image}})">
                                        <a class="btn btn-sm btn-danger font-12 d-table" href="/deleteImg/{{$img->id}}/{{$id}}"><i class="fa fa-trash"></i></a>
                                    </div>
                                @endforeach
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="pagetext">Тайлбар:</label>
                            <textarea name="contentHTML" id="pagetext" rows="10">{{$content}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a class="btn btn-sm btn-light" href="{{asset('events')}}">Буцах</a>
                        <input type="hidden" name="id" value="{{$id}}">
                        <button name="submit" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Хадгалах</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
