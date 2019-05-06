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
                {!! $event->content !!}
            </div>
            <div class="col-sm-3">
                <div class="font-14" style="min-height: 50px">
                @if($createUser->profile_pic)
                    <div class="profile_pic mr-2" style="float: left;width:50px;height:50px;background-image: url({{asset('uploads/'.$createUser->profile_pic)}}"></div>
                @else
                    <img style="opacity: 0.5;border-radius: 50%" width="65" src="https://britz.mcmaster.ca/images/nouserimage.gif/image">
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
            </div>
        </div>
    </div>
    <script>
        function rating(value,event_id){
            var formData = {
                _token: $("#_token").val(),
                event_id: event_id,
                value: value
            }
            $.ajax({
                type:'POST',
                url:'/event_rate',
                data: formData,
                success:function(data){
                    if(data.success == "true"){
                        $("#_token").val(data._token)
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
            }
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
