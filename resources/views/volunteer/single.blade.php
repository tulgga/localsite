@extends('volunteer.body')
@section('meta')
    <title>{{$event->subject}}</title>
    <meta name="title" content="{{$event->subject}}">
    <meta name="keywords" content="{{$event->subject}}">
    <meta name="description" content="{{$event->subject}}">
@endsection
@section('content')
    <div class="container mt-5 mb-5 bg-white rounded p-4">
        <div class="row">
            <div class="col-sm-9">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @php $i=0; @endphp
                        @foreach($images as $img)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if($i == 0) class="active" @endif></li>
                        @php $i++; @endphp
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @php $s=1; @endphp
                        @foreach($images as $img)
                        <div class="carousel-item @if($s == 1) active @endif">
                            <div style="background-image: url('{{asset('uploads/'.$img->image)}}');" class="d-block w-100 thumbs" alt="{{$event->subject}}"></div>
                        </div>
                        @php $s++; @endphp
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <h5 class="pt-3 font-weight-bold">{{$event->subject}}</h5>
                <content>
                {!! $event->content !!}
                </content>
                <h6>Уншигчдын сэтгэгдэл:</h6>
                <hr/>
                <ul class="list-comments mb-4 list-group font-14">
                    @php $i=1; @endphp
                    @foreach($comments as $comment)
                        <li class="list-group-item" @if($i%2 == 0) style="background: #fafafa" @endif>
                            <div class="mb-2">
                            @if($comment->profile_pic)
                                <div class="profile_pic" style="width:25px;height:25px;background-image: url({{asset('uploads/'.$comment->profile_pic)}}"></div>
                            @else
                                <img style="border-radius: 50%" width="25" src="https://britz.mcmaster.ca/images/nouserimage.gif/image">
                            @endif
                            @if($comment->firstname)
                                    <strong>{{$comment->firstname}}</strong>
                            @else
                                    <strong>Зочин</strong>
                            @endif &nbsp;|&nbsp; <i class="fa fa-clock text-warning"></i> {{$comment->created_at}} &nbsp;|&nbsp; <i class="fa fa-map-marker-alt text-danger"></i> {{$comment->ips}}
                            </div>
                            {{$comment->comment}}
                        </li>
                    @php $i++; @endphp
                    @endforeach
                </ul>
                <p><strong>Сэтгэгдэл бичих:</strong></p>
                @if(Session::has('successMsg'))
                    <div class="alert alert-success font-14"><i class="fa fa-check"></i> {{ Session::get('successMsg') }} </div>
                @endif
                <form method="post" action="{{asset('sendComment')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                    <textarea class="form-control" name="comment" rows="5" placeholder="Та энд сэтгэгдлээ бичнэ үү..." required></textarea>
                    </div>
                    <div class="form-group text-right">
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <input type="hidden" name="back_url" value="{{$_SERVER['REQUEST_URI']}}">
                        <button type="reset" class="btn btn-outline-secondary"><i class="fa fa-eraser"></i> </button>
                        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Сэтгэгдэл илгээх</button>
                    </div>
                </form>
            </div>
            <div class="col-sm-3">
                <div class="font-14" style="min-height: 50px">
                @if(is_null($createUser->profile_pic))
                        <img style="opacity: 0.5;border-radius: 50%" width="65" src="https://britz.mcmaster.ca/images/nouserimage.gif/image">
                @else
                        <div class="profile_pic mr-2" style="float: left;width:50px;height:50px;background-image: url({{asset('uploads/'.$createUser->profile_pic)}}"></div>
                @endif
                <em style="color:var(--gray)">Нийтлэгч:</em>
                <p>{{ $createUser->lastname }} {{ $createUser->firstname }}</p>
                </div>

                <div class="font-14">
                    <i class="fa fa-clock" style="color:var(--gray)"></i> {{ $event->created_at }} &nbsp;&nbsp; <i class="fa fa-heart" style="color:var(--red)"></i> <span class="likes">{{$likes->counts}}</span>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-6 border-right font-14 like_{{$event->id}}">
                        @if(is_null(Auth::user()))
                            <a href="#" data-toggle="modal" data-target="#LoginForm" class="text-secondary"><i class="far fa-heart"></i> Таалагдлаа</a>
                        @else
                            @php $likes = DB::table('event_to_likes')->select('event_id')->where('event_id',$event->id)->where('user_id',Auth::user()->id)->first(); @endphp
                            @if($likes)
                                <a href="javascript:likeQuery({{$event->id}});" class="text-primary"><i class="fa fa-heart"></i> Таалагдсан</a>
                            @else
                                <a href="javascript:likeQuery({{$event->id}});" class="text-secondary"><i class="far fa-heart"></i> Таалагдлаа</a>
                            @endif
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="rate_thanks rating_{{$event->id}}">Баярлалаа</div>
                        <div class="font-16 rating-stars text-right">
                            @if(is_null($rating->rate))
                                @if(is_null(Auth::user()))
                                    <ul id='stars'>
                                        <li class='star' data-value='1' title='Муу' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star' data-value='2' title='Дунд' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star' data-value='3' title='Сайн' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star' data-value='4' title='Маш сайн' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star' data-value='5' title='Гайхалтай' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                    </ul>
                                @else
                                    <ul id='stars'>
                                        <li class='star' data-value='1' title='Муу' onclick="rating(1,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star' data-value='2' title='Дунд' onclick="rating(2,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star' data-value='3' title='Сайн' onclick="rating(3,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star' data-value='4' title='Маш сайн' onclick="rating(4,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star' data-value='5' title='Гайхалтай' onclick="rating(5,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                    </ul>
                                @endif
                            @else
                                @if(is_null(Auth::user()))
                                    <ul id='stars'>
                                        <li class='star @if($rating->rate >= 1) selected @endif' data-value='1' title='Муу' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star @if($rating->rate >= 2) selected @endif' data-value='2' title='Дунд' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star @if($rating->rate >= 3) selected @endif' data-value='3' title='Сайн' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star @if($rating->rate >= 4) selected @endif' data-value='4' title='Маш сайн' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star @if($rating->rate >= 5) selected @endif' data-value='5' title='Гайхалтай' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                    </ul>
                                @else
                                    <ul id='stars'>
                                        <li class='star @if($rating->rate >= 1) selected @endif' data-value='1' title='Муу' onclick="rating(1,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star @if($rating->rate >= 2) selected @endif' data-value='2' title='Дунд' onclick="rating(2,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star @if($rating->rate >= 3) selected @endif' data-value='3' title='Сайн' onclick="rating(3,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star @if($rating->rate >= 4) selected @endif' data-value='4' title='Маш сайн' onclick="rating(4,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                        <li class='star @if($rating->rate == 5) selected @endif' data-value='5' title='Гайхалтай' onclick="rating(5,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                    </ul>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @if(is_null($users) || $users !== "[]")
                <div class="row">
                    <div class="col-sm-12 userss">
                    <h4>Оролцогчид</h4>
                    <ul>
                        @foreach($users as $usr)
                            @if($usr->user_id == 0)
                                <li><i class="fa fa-user"></i> {{$usr->description}}</li>
                            @else
                                <li>
                                    @if($usr->profile_usr)
                                    <i class="fa fa-user"></i>
                                    @else
                                        <div class="profile_pic mr-2" style="width:25px;height:25px;background-image: url({{asset('uploads/'.$createUser->profile_pic)}}"></div>
                                    @endif
                                    {{$usr->lastname.' '.$usr->firstname}}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        function rating(value,event_id){
            var formData = {
                _token: $("#_token").val(),
                event_id: event_id,
                value: value
            };
            $.ajax({
                type:'POST',
                url:'/event_rate',
                data: formData,
                success:function(data){
                    if(data.success == "true"){
                        $("#_token").val(data._token);
                        $(".rating_"+event_id).fadeIn(200);
                        setInterval(function(){ $(".rating_"+event_id).fadeOut(200); }, 1000);
                    }
                }
            });
        }
        likeQuery = function (event_id) {
            var likeCount = parseInt($(".likes").text());
            var formData = {
                _token: $("#_token").val(),
                event_id: event_id
            };
            $.ajax({
                type:'POST',
                url:'/event_like',
                data: formData,
                success:function(data){
                    //console.log(data);
                    if(data.result == 'like'){
                        $(".like_"+event_id).html('<a href="javascript:likeQuery('+event_id+');" class="text-primary"><i class="fa fa-heart"></i> Таалагдсан</a>');
                        $("#_token").val(data._token);
                        $(".likes").html(likeCount+1);
                    }else if(data.result == 'unlike'){
                        $(".like_"+event_id).html('<a href="javascript:likeQuery('+event_id+');" class="text-secondary"><i class="far fa-heart"></i> Таалагдлаа</a>');
                        $("#_token").val(data._token);
                        $(".likes").html(likeCount-1);
                    }
                }
            });
        }
    </script>
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
@endsection
