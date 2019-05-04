@extends('volunteer.body')
@section('meta')
    <title>Хувийн мэдээлэл</title>
    <meta name="title" content="Хувийн мэдээлэл">
    <meta name="keywords" content="Хувийн мэдээлэл">
    <meta name="description" content="Хувийн мэдээлэл">
@endsection
@section('content')
<div class="container mt-5 mb-5 bg-white rounded pt-4">
    <div class="row">
        <div class="col-sm-12">
            @if(Session::has('successMsg'))
                <div class="alert alert-success font-14"><i class="fa fa-check"></i> {{ Session::get('successMsg') }} </div>
            @endif
            <h6>Таны оруулсан сайн дурын ажлууд: <a href="{{asset('eventform')}}/0" class="btn btn-sm btn-success">Шинээр нэмэх</a></h6>
                <table class="table font-14">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Гарчиг</th>
                        <th scope="col">Огноо</th>
                        <th scope="col">Үүссэн</th>
                        <th scope="col">Төлөв</th>
                        <th scope="col" width="90">Үйлдэл</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>@foreach($events as $event)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$event->subject}}</td>
                            <td>
                                @if($event->ended < date('Y-m-d'))
                                    <span class="text-secondary">{{$event->started}}
                                    <i class="fa fa-caret-right"></i>
                                    {{$event->ended}}</span><i class="font-12"> (Дууссан)</i>
                                @elseif($event->started > date('Y-m-d'))
                                    <span class="text-warning">{{$event->started}}
                                        <i class="fa fa-caret-right"></i>
                                        {{$event->ended}}</span><i class="font-12"> (Удахгүй)</i>
                                @else
                                    <span class="text-success">{{$event->started}}</span>
                                    <i class="fa fa-caret-right"></i>
                                    <span class="text-danger">{{$event->ended}}</span><i class="font-12"> (Эхэлсэн)</i>
                                @endif
                            </td>
                            <td>{{$event->created_at}}</td>
                            <td>
                                @if($event->status == 1)
                                <a href="{{asset('eventUpdateStatus')}}/{{$event->id}}/0" class="btn btn-sm btn-success font-12">Нийтэлсэн</a>
                                @else
                                <a href="{{asset('eventUpdateStatus')}}/{{$event->id}}/1" class="btn btn-sm btn-secondary font-12">Нийтлэх</a>
                                @endif
                            </td>
                            <td>
                                <a title="Засах" href="{{asset('eventform')}}/{{$event->id}}" class="btn btn-sm btn-secondary font-12"><i class="fa fa-cog"></i> </a>
                                <a title="Устгах" href="{{asset('eventdelete')}}/{{$event->id}}" class="btn btn-sm btn-danger font-12"><i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>


        </div>
    </div>
</div>
@endsection
