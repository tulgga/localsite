@extends('volunteer.body')
@section('meta')
    <title>Байгууллагын мэдээлэл</title>
    <meta name="title" content="Байгууллагын мэдээлэл">
    <meta name="keywords" content="Байгууллагын мэдээлэл">
    <meta name="description" content="Байгууллагын мэдээлэл">
@endsection
@section('content')
<div class="container mt-5 mb-5 bg-white rounded pt-4">
    <div class="row">
        <div class="col-sm-12">
            @if(Session::has('successMsg'))
                <div class="alert alert-success font-14"><i class="fa fa-check"></i> {{ Session::get('successMsg') }} </div>
            @endif
            <h6>Байгууллагын мэдээлэл: <a href="{{asset('organizationform')}}/0" class="btn btn-sm btn-success">Шинээр нэмэх</a></h6>
                <table class="table font-14">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Лого</th>
                        <th scope="col">Байгууллагын нэр</th>
                        <th scope="col">Бүртгэсэн огноо</th>
                        <th scope="col">Төлөв</th>
                        <th scope="col" width="90">Үйлдэл</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>@foreach($events as $event)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>
                                @if($event->logo)
                                    <div class="profile_pic" style="width:35px;height:35px;background-image: url({{asset('uploads/'.$event->logo)}}"></div>
                                @else
                                    <img style="opacity: 0.5;border-radius: 50%" width="35" src="https://britz.mcmaster.ca/images/nouserimage.gif/image">
                                @endif
                            </td>
                            <td>{{$event->name}}</td>
                            <td>{{$event->created_at}}</td>
                            <td>
                                @if($event->status == 1)
                                <a href="{{asset('organizationUpdateStatus')}}/{{$event->id}}/0" class="btn btn-sm btn-success font-12">Нийтэлсэн</a>
                                @else
                                <a href="{{asset('organizationUpdateStatus')}}/{{$event->id}}/1" class="btn btn-sm btn-secondary font-12">Нийтлэх</a>
                                @endif
                            </td>
                            <td>
                                <a title="Засах" href="{{asset('organizationform')}}/{{$event->id}}" class="btn btn-sm btn-secondary font-12"><i class="fa fa-cog"></i> </a>
                                <a title="Устгах" href="{{asset('organizationdelete')}}/{{$event->id}}" class="btn btn-sm btn-danger font-12"><i class="fa fa-trash"></i> </a>
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
