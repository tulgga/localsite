@extends('volunteer.body')
@section('meta')
    <title>Сайн дурын ажлууд</title>
    <meta name="title" content="Сайн дурын ажлууд">
    <meta name="keywords" content="Сайн дурын ажлууд">
    <meta name="description" content="Сайн дурын ажлууд">
@endsection
@section('content')
<section class="four-column current-projects no-padd-top">
<div class="container mt-5 mb-5">
    <div class="row clearfix">
    @foreach($events as $event)
        <!--Project Column-->
            <div class="col-sm-3 column project-column">
                <article class="column-inner hvr-float-shadow">
                    <figure class="image-box" style="background-image: url('/uploads/{{$event->image}}');"></figure>
                    <div class="lower-part">
                        <div class="text">
                            <a href="{{asset('event/'.$event->id)}}"><h3>{{$event->subject}}</h3></a>
                            <p>{{strip_tags(substr($event->content,0,200))}}</p>
                        </div>
                        <div class="row @if($event->ended < date('Y-m-d')) ended @elseif($event->started > date('Y-m-d')) comingsoon @else active @endif">
                            <div class="col-sm-6 font-14 border-right like_{{$event->id}}">
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
                                <div class="rating-stars float-right font-16">
                                    @if(is_null($event->rate))
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
                                                <li class='star @if($event->rate >= 1) selected @endif' data-value='1' title='Муу' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                                <li class='star @if($event->rate >= 2) selected @endif' data-value='2' title='Дунд' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                                <li class='star @if($event->rate >= 3) selected @endif' data-value='3' title='Сайн' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                                <li class='star @if($event->rate >= 4) selected @endif' data-value='4' title='Маш сайн' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                                <li class='star @if($event->rate >= 5) selected @endif' data-value='5' title='Гайхалтай' data-toggle="modal" data-target="#LoginForm"><i class='fa fa-star fa-fw'></i></li>
                                            </ul>
                                        @else
                                            <ul id='stars'>
                                                <li class='star @if($event->rate >= 1) selected @endif' data-value='1' title='Муу' onclick="rating(1,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                                <li class='star @if($event->rate >= 2) selected @endif' data-value='2' title='Дунд' onclick="rating(2,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                                <li class='star @if($event->rate >= 3) selected @endif' data-value='3' title='Сайн' onclick="rating(3,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                                <li class='star @if($event->rate >= 4) selected @endif' data-value='4' title='Маш сайн' onclick="rating(4,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                                <li class='star @if($event->rate == 5) selected @endif' data-value='5' title='Гайхалтай' onclick="rating(5,{{$event->id}}); return false;"><i class='fa fa-star fa-fw'></i></li>
                                            </ul>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
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
                            $("#_token").val(data._token)
                        }else if(data.result == 'unlike'){
                            $(".like_"+event_id).html('<a href="javascript:likeQuery('+event_id+');" class="text-secondary"><i class="far fa-heart"></i> Таалагдлаа</a>');
                            $("#_token").val(data._token)
                        }
                    }
                });
            }
        </script>
    </div>
</div>
    <input type="hidden" id="_token" value="{{ csrf_token() }}">
</section>
@endsection
