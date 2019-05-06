<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <link rel="stylesheet" href="{{ asset('main/zar/css/bootstrap.min.css')}}">
    <script src="{{ asset('main/zar/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('main/zar/js/popper.js') }}"></script>
    <script src="{{ asset('main/zar/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/chartjs.min.js') }}"></script>
    <link href="{{ asset('/dashboard/index.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="d_n">
    <div class="d_nt"> Удирдлагын нэгтгэсэн мэдээ: {{$y}} </div>
</div>

<div class="wrapper">
    <div class="row">
        <div class="col-sm-3">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Цагдаагийн газар</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i>dd</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="policeChart"></canvas>
                    </div>
                    <div class='c_m'>
                        <div class="c">
                            <div class="c_b">
                                <p class="row c_bt"> Гэмт хэрэг </p>
                                <p class="row c_i">
                                    <b class="c_ik"> Хүн амь </b><b class="c_iv"> {{$p!=null ?$p->crime_kill: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Хулгай </b><b class="c_iv"> {{$p!=null ?$p->crime_theft: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Хөдөлгөөний аюулгүй байдал </b><b class="c_iv"> {{$p!=null ?$p->crime_movement: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Бусад </b><b class="c_iv"> {{$p!=null ?$p->crime_other: 0}} </b>
                                </p>

                                <p class="row c_bt"> Захиргааны зөрчил </p>
                                <p class="row c_i">
                                    <b class="c_ik"> Гэр бүрлийн хүчирхийлэл </b><b class="c_iv"> {{$p!=null ?$p->ac_family: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Эрүүлжүүлэх </b><b class="c_iv"> {{$p!=null ?$p->ac_healing: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Баривчлагдсан </b><b class="c_iv"> {{$p!=null ?$p->ac_arrest: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Торгууль </b><b class="c_iv"> {{$p!=null ?$p->ac_fine: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Бусад </b><b class="c_iv"> {{$p!=null ?$p->ac_other: 0}} </b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-sm-3">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Эрүүл мэндийн төв</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> 763,215</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="hospitalChart"></canvas>
                    </div>
                    <div class='c_m'>
                        <div class="c">
                            <div class="c_b">
                                <p class="row c_i">
                                    <b class="c_ik"> Төрсөн </b><b class="c_iv"> {{$h!=null ?$h->birth: 0}} </b>
                                </p>


                                <p class="row c_i">
                                    <b class="c_ik"> Нас барсан </b><b class="c_iv"> {{$h!=null ?$h->die: 0}}  </b>
                                </p>



                                <p class="row c_i">
                                    <b class="c_ik"> Урьдчилан сэргийлэх үзлэг </b><b class="c_iv"> {{$h!=null ?$h->inspection: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Хэвтэн эмчлүүлэгч </b><b class="c_iv"> {{$h!=null ?$h->inpatient: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Яаралтай тусламжийн төвөөр </b><b class="c_iv"> {{$h!=null ?$h->ytt: 0}} </b>
                                </p>


                                <p class="row c_bt"> Дуудлага </p>
                                <p class="row c_i">
                                    <b class="c_ik"> Ойрын </b><b class="c_iv"> {{$h!=null ?$h->call_near: 0}} </b>
                                </p>

                                <p class="row c_i">
                                    <b class="c_ik"> Холын </b><b class="c_iv"> {{$h!=null ?$h->call_remote : 0 }} </b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='row c_m'>


        <div class='col-sm-2'>
            <div class="c">
                <div class="c_t"> Онцгой байдлын газар </div>
                <div class="c_b">
                    <p class="row c_bt"> Түймэр </p>
                    <p class="row c_i">
                        <b class="c_ik"> Ойн хээрийн </b><b class="c_iv"> {{$n!=null ? $n->fo : 0 }} </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> объектын </b><b class="c_iv"> {{$n!=null ? $n->ff : 0 }} </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> зөрчил </b><b class="c_iv"> {{$n!=null ? $n->f : 0 }} </b>
                    </p>

                    <p class="row c_bt"> Аюул үзэгдэл, ослын дуудлага </p>
                    <p class="row c_i">
                        <b class="c_ik"> тоо </b><b class="c_iv"> {{$n!=null ? $n->sos : 0 }} </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> {{$n!=null ?$n->sos_description : '' }} </b>
                    </p>
                </div>
            </div>
        </div>


        <div class='col-sm-4'>

            <div class="c">
                <div class="c_t"> Төсөв </div>
                <div class="c_b">
                    @if($b)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Төсөв</th>
                            <th scope="col">батлагдсан</th>
                            <th scope="col">зарцуулагдсан</th>
                            <th scope="col">хэрэгжиж байгаа</th>
                            <th scope="col">үлдэгдэл</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($b as $i)
                            <tr>
                                <th scope="row">
                                    @if($i->b_type==1)
                                        <p>Улсын</p>
                                    @elseif($i->b_type==2)
                                        <p>ОНХС</p>
                                    @elseif($i->b_type==3)
                                        <p>Замын сан</p>
                                    @elseif($i->b_type==4)
                                        <p>ЗД-ын нөөц</p>
                                    @else
                                        <p>-</p>
                                    @endif
                                </th>
                                <td>{{$i->b_approved}}</td>
                                <td>{{$i->b_done}}</td>
                                <td>{{$i->b_doing}}</td>
                                <td>{{$i->b_do}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class='row c_m'>
        <div class='col-sm-4'>
            <div class="c">
                <div class="c_t"> Ажлын төлөвлөгөө </div>
                <div class="c_b">
                    @php
                        $s_date = "";
                    @endphp

                    @if($s)
                        @foreach($s as $i)
                            @if($s_date== "")
                                @php
                                    $s_date = $s_date== "" ? $i->schedule_date : $s_date;
                                @endphp
                                <p class="row c_bt"> {{$i->schedule_date}}</p>
                            @else
                            @endif

                            @if($i->schedule_date == $s_date)
                                <p class="row c_i">
                                    <b class="c_ik"> {{$i->start_time}} - {{$i->end_time}} </b><b class="c_iv"> {{$i->description}}</b>
                                </p>
                            @else
                                @php
                                    $s_date = $i->schedule_date;
                                @endphp
                                <p class="row c_bt"> {{$i->schedule_date}}</p>
                                <p class="row c_i">
                                    <b class="c_ik"> {{$i->start_time}} - {{$i->end_time}} </b><b class="c_iv"> {{$i->description}}</b>
                                </p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>


        <div class='col-sm-4'>

            <div class="c">
                <div class="c_t"> Өнөөдөр болох үйл ажиллагаанууд </div>
                <div class="c_b">
                    @if($t)
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($t as $i)
                                    @if($i->id == $t[0]->id)
                                        <div class="carousel-item active">
                                            <div class='row'>
                                                <div class='col-sm' id='item1'>
                                                    <h3>{{$i->description}} </h3>
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
                                                    <h3>{{$i->description}} </h3>
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
                </div>
            </div>
        </div>


        <div class='col-sm-4'>
            <div class="c">
                <div class="c_t"> Цаг үеийн асуудал </div>
                <div class="c_b">
                    @if($news)
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($news as $i)
                                    @if($i->id == $news[0]->id)
                                        <div class="carousel-item active">
                                            <div class='row'>
                                                <div class='col-sm' id='item1'>
                                                    <h3>{{$i->desc}} </h3>
                                                    @if($i->created_type==1)
                                                        <p>Цагдаа</p>
                                                    @elseif($i->created_type==2)
                                                        <p>эрүүл мэндийн төв</p>
                                                    @elseif($i->created_type==3)
                                                        <p>онцгой</p>
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
                                                <div class='col-sm' id='item1'>
                                                    <h3>{{$i->desc}} </h3>
                                                    @if($i->created_type==1)
                                                        <p>Цагдаа</p>
                                                    @elseif($i->created_type==2)
                                                        <p>эрүүл мэндийн төв</p>
                                                    @elseif($i->created_type==3)
                                                        <p>онцгой</p>
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
            <div class="c">
                <div class="c_t"> Цаг агаар </div>
                <div class="c_b">
                    <iframe src = "/html/menu.htm" width = "555" height = "200">
                        Sorry your browser does not support inline frames.
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('dashboard/index.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        optionChart = {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#f5f5f5',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,
            scales: {
                yAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(29,140,248,0.0)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }],

                xAxes: [{
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: 'rgba(225,78,202,0.1)',
                        zeroLineColor: "transparent",
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }]
            }
        };


        var ctx = document.getElementById("policeChart").getContext("2d");

        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

        var data = {
            labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
                label: "Data",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#d048b6',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: [80, 100, 70, 80, 120, 80],
            }]
        };

        var chart1 = new Chart(ctx, {
            type: 'line',
            data: data,
            options: optionChart
        });


        var ctx = document.getElementById("hospitalChart").getContext("2d");

        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

        var data1 = {
            labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [{
                label: "Data",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: '#d048b6',
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: '#d048b6',
                pointBorderColor: 'rgba(255,255,255,0)',
                pointHoverBackgroundColor: '#d048b6',
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: [80, 100, 70, 80, 120, 80],
            }]
        };

        var chart2 = new Chart(ctx, {
            type: 'line',
            data: data1,
            options: optionChart
        });

    });
</script>
</body>
</html>



