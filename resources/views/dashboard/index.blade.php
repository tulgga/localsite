<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta')
        <link rel="stylesheet" href="{{ asset('main/zar/css/bootstrap.min.css')}}">
        <script src="{{ asset('main/zar/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('main/zar/js/popper.js') }}"></script>
        <script src="{{ asset('main/zar/js/bootstrap.min.js') }}"></script>
        <link href="{{ asset('/dashboard/index.css') }}" rel="stylesheet" type="text/css">

        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

        <title>DASHBOARD</title>
    </head>
    <?php

    $dataPoints = array(
        array("y" => 25, "label" => "Sunday"),
        array("y" => 15, "label" => "Monday"),
        array("y" => 25, "label" => "Tuesday"),
        array("y" => 5, "label" => "Wednesday"),
        array("y" => 10, "label" => "Thursday"),
        array("y" => 0, "label" => "Friday"),
        array("y" => 20, "label" => "Saturday")
    );

    ?>





    <body class="full-height mh-100 mw-100">
        <div class="col-sm-12">
            <div class="h-auto item_cell row">
                <div class="h-auto item_cell col-sm-3">
                    <div class="h-100 child third">
                        <p class="count">{{$today}}</p>
                        <h1 class="title">Өнөөдөр</h1>
                    </div>
                </div>


                <div class="h-auto item_cell col-sm-3">
                    <div class="h-100 child first">
                        <p class="count">{{$h !=null ? (int)$h->total : 0}}</p>
                        <h1 class="title">Эрүүл мэндийн төв</h1>
                        <div id="hospital_chart"></div>
                    </div>
                </div>

                <div class="h-auto item_cell col-sm-3">
                    <div class="h-100 child second">
                        <p class="count">{{$p !=null ? (int)$p->total : 0}}</p>
                        <h1 class="title">Цагдаагийн газар</h1>
                        <div id="police_chart"></div>
                    </div>
                </div>


                <div class="h-auto item_cell col-sm-3">
                    <div class="h-100 child third">
                        <p class="count">{{$n !=null ? (int)$n->total : 0}}</p>
                        <h1 class="title">Онцгой байдлын газар</h1>
                        <div id="nema_chart"></div>
                    </div>
                </div>


            </div>
            <div class="h-40 item_cell row">
                <div class="h-auto item_cell col-sm-3">
                    <div class="h-100 child fourth">
                        <h1 class="title">Дэлгэрэнгүй мэдээлэл</h1>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class='col-sm' id='item1'>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" colspan="2">Цагдаагийн газар(Гэмт хэрэг)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr><th scope="row">Хүн амь</th><td>{{$p!=null ?$p->crime_kill: 0}}</td></tr>
                                            <tr><th scope="row">Хулгай </th><td>{{$p!=null ?$p->crime_theft: 0}}</td></tr>
                                            <tr><th scope="row">Хөдөлгөөний аюулгүй байдал </th><td>{{$p!=null ?$p->crime_movement: 0}}</td></tr>
                                            <tr><th scope="row">Бусад </th><td>{{$p!=null ?$p->crime_other: 0}}</td></tr>
                                            <tr><th></th><td>-</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class='col-sm' id='item2'>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col" colspan="2">Цагдаагийн газар(Захиргааны зөрчил)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr><th scope="row">Гэр бүрлийн хүчирхийлэл </th><td>{{$p!=null ?$p->ac_family: 0}}</td></tr>
                                            <tr><th scope="row">Эрүүлжүүлэх</th><td>{{$p!=null ?$p->ac_healing: 0}}</td></tr>
                                            <tr><th scope="row">Баривчлагдсан </th><td>{{$p!=null ?$p->ac_arrest: 0}}</td></tr>
                                            <tr><th scope="row">Торгууль </th><td>{{$p!=null ?$p->ac_fine: 0}}</td></tr>
                                            <tr><th scope="row">Бусад </th><td>{{$p!=null ?$p->ac_other: 0}}</td></tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class='col-sm' id='item3'>
                                        <table class="table">
                                            <thead><tr><th scope="col" colspan="2">Эрүүл мэндийн төв</th></tr></thead>
                                            <tbody>
                                            <tr><th scope="row">Төрсөн хүний тоо</th><td>{{$h!=null ?$h->birth: 0}}</td></tr>
                                            <tr><th scope="row">Нас барсан хүний тоо</th><td>{{$h!=null ?$h->die: 0}}</td></tr>
                                            <tr><th scope="row">Урьдчилан сэргийлэх үзлэг </th><td>{{$h!=null ?$h->inspection: 0}}</td></tr>
                                            <tr><th scope="row">Яаралтай тусламжийн төвөөр </th><td>{{$h!=null ?$h->ytt: 0}}</td></tr>
                                            <tr><th scope="row">Дуудлага ойр/алсын </th><td>{{$h!=null ?$h->call_near: 0}}/{{$h!=null ?$h->call_remote : 0 }}</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class='col-sm' id='item4'>
                                        <table class="table">
                                            <thead><tr><th scope="col" colspan="2">Онцгой байдлын газар</th></tr></thead>
                                            <tbody>
                                            <tr><th scope="row">Түймэр</th><td></td></tr>
                                            <tr><th scope="row">Ойн хээрийн</th><td>{{$n!=null ?$n->fo: 0}}</td></tr>
                                            <tr><th scope="row">объектын</th><td>{{$n!=null ?$n->ff: 0}}</td></tr>
                                            <tr><th scope="row">Аюул үзэгдэл, ослын дуудлага</th><td>{{$n!=null ?$n->sos: 0}}</td></tr>
                                            <tr><th scope="row" colspan="2">{{$n!=null ? $n->sos_description : ''}}</th></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-auto item_cell col-sm-3">
                    <div class="h-100 child second">
                        <h1 class="title"> ЭВЭНТ</h1>
                        @if($t)
                            <div id="carouselEvent" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($t as $i)
                                        @if($i->id == $t[0]->id)
                                            <div class="carousel-item {{$i->id==$t[0]->id ? 'active' : ''}}">
                                                <div class='row'>
                                                    <div class='col-sm' id='item1{{$i->id}}'>
                                                        <h3 style="font-size: 15px;">{{$i->description}} </h3>
                                                        @if($i->head_id==4)
                                                            <p>ХДТ</p>
                                                        @elseif($i->head_id==5)
                                                            <p>Тэмүжин театр</p>
                                                        @elseif($i->head_id==6)
                                                            <p>Баганат талбайд</p>
                                                        @elseif($i->head_id==7)
                                                            <p>ЗДТГын зааланд</p>
                                                        @elseif($i->head_id==8)
                                                            <p>Сумын ЗДТГын зааланд</p>
                                                        @elseif($i->head_id==9)
                                                            <p>Бусад</p>
                                                        @else
                                                            <p>-</p>
                                                        @endif
                                                        <p>{{$i->schedule_date}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <div class='row'>
                                                    <div class='col-sm' id='item1'>
                                                        <h3 style="font-size: 15px;">{{$i->description}} </h3>
                                                        @if($i->head_id==4)
                                                            <p>ХДТ</p>
                                                        @elseif($i->head_id==5)
                                                            <p>Тэмүжин театр</p>
                                                        @elseif($i->head_id==6)
                                                            <p>Баганат талбайд</p>
                                                        @elseif($i->head_id==7)
                                                            <p>ЗДТГын зааланд</p>
                                                        @elseif($i->head_id==8)
                                                            <p>Сумын ЗДТГын зааланд</p>
                                                        @elseif($i->head_id==9)
                                                            <p>Бусад</p>
                                                        @else
                                                            <p>-</p>
                                                        @endif
                                                        <p>{{$i->schedule_date}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <br/>
                        @if(count($news)>0)
                            <h1 class="title"> Цаг үеийн асуудал</h1>
                            <div id="carouselNews" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($news as $i)
                                        @if($i->id == $news[0]->id)
                                            <div class="carousel-item {{$i->id==$news[0]->id ? 'active' : ''}}">
                                                <div class='row'>
                                                    <div class='col-sm' id='item_news_{{$i->id}}'>
                                                        <h3 style="font-size: 15px;">{{$i->desc}} </h3>
                                                        @if($i->created_type==1)
                                                            <p>Цагдаа</p>
                                                        @elseif($i->created_type==2)
                                                            <p>эрүүл мэнд</p>
                                                        @elseif($i->created_type==3)
                                                            <p>Онцгой</p>
                                                        @else
                                                            <p>-</p>
                                                        @endif
                                                        <p>{{$i->created_at}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <div class='row'>
                                                    <div class='col-sm' id='item_news_{{$i->id}}'>
                                                        <h3 style="font-size: 15px;">{{$i->desc}} </h3>
                                                        @if($i->created_type==1)
                                                            <p>Цагдаа</p>
                                                        @elseif($i->created_type==2)
                                                            <p>эрүүл мэнд</p>
                                                        @elseif($i->created_type==3)
                                                            <p>Онцгой</p>
                                                        @else
                                                            <p>-</p>
                                                        @endif
                                                        <p>{{$i->created_at}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="h-auto item_cell col-sm-6">
                    @if($budgets)
                        <table class="table h-100 child first">
                            <thead>
                            <tr><th colspan="5">Төсөв</th></tr>
                                <tr>
                                    <th></th>
                                    <th scope="col">батлагдсан</th>
                                    <th scope="col">зарцуулагдсан</th>
                                    <th scope="col">хэрэгжиж байгаа</th>
                                    <th scope="col">үлдэгдэл</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($budgets as $budget)
                                <tr>
                                    <th scope="row">
                                        @if($budget!=null)
                                            @if($budget->b_type==1)
                                                Улсын
                                            @elseif($budget->b_type==2)
                                                ОНХС
                                            @elseif($budget->b_type==3)
                                                Замын сан
                                            @elseif($budget->b_type==4)
                                                ЗД-ын нөөц
                                            @else
                                                Төсвийн нэр
                                            @endif
                                        @else
                                            Төсвийн нэр
                                        @endif
                                    </th>
                                    <td>{{$budget!=null ? $budget->b_approved : 0}}</td>
                                    <td>{{$budget!=null ? $budget->b_done : 0}}</td>
                                    <td>{{$budget!=null ? $budget->b_doing : 0}}</td>
                                    <td>{{$budget!=null ? $budget->b_do : 0}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>



            </div>
            <div class="h-30 item_cell row">
                <div class="h-100 item_cell col-sm-12">
                    <div class="h-50 child first">
                        <div><h1 class="title">Цагийн хуваарь</h1></div>
                        <div class="row">

                        @foreach($owner_schedule as $schedule)
                            <table class="table col-sm-4 border_none " >
                                <thead>
                                <tr>
                                    <th>{{$schedule['date']}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($schedule['data'] as $row)
                                    <tr>
                                        <th scope="">
                                            {{$row->start_time}} - {{$row->end_time}} <br/>
                                            {{$row->description}}
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="h-100 item_cell col-sm-4">


                </div>
            </div>
        </div>

        <script>
            am4core.ready(function() {
                var chart = am4core.create("police_chart", am4charts.XYChart);
                chart.paddingRight = 0;
                chart.data = <?=json_encode($chart_data)?>;

                // Create axes
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.grid.template.location = 0;
                dateAxis.renderer.minGridDistance = 50;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "police_count";
                series.dataFields.dateX = "date";
                series.strokeWidth = 3;
                series.fillOpacity = 0.5;
            });
        </script>

        <script>
            am4core.ready(function() {
                var chart = am4core.create("hospital_chart", am4charts.XYChart);
                chart.paddingRight = 0;
                chart.data = <?=json_encode($chart_data)?>;

                // Create axes
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.grid.template.location = 0;
                dateAxis.renderer.minGridDistance = 50;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "hospital_count";
                series.dataFields.dateX = "date";
                series.strokeWidth = 3;
                series.fillOpacity = 0.5;
            });
        </script>

        <script>
            am4core.ready(function() {
                var chart = am4core.create("nema_chart", am4charts.XYChart);
                chart.paddingRight = 0;
                chart.data = <?=json_encode($chart_data)?>;

                // Create axes
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.grid.template.location = 0;
                dateAxis.renderer.minGridDistance = 50;

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "nema_count";
                series.dataFields.dateX = "date";
                series.strokeWidth = 3;
                series.fillOpacity = 0.5;
            });
        </script>
    </body>
</html>
