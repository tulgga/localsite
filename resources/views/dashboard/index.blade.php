<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta')
        <link rel="stylesheet" href="{{ asset('dashboard/bootstrap.min.css')}}">
        <script src="{{ asset('main/zar/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('main/zar/js/popper.js') }}"></script>
        <script src="{{ asset('main/zar/js/bootstrap.min.js') }}"></script>

        <link href="{{ asset('/dashboard/index.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('main/volunteer/fontawesome/css/all.css') }}">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <title>DASHBOARD</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    </head>
    <body class="full-height">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/doctor.png')}}"/> <span>Эрүүл мэндийн салбар</span></h1>
                        <ul class="grid-list-item clearfix">
                            <li><div class="item"><span class="num">{{$h!=null ?$h->birth: 0}}</span><span class="title" style="border-color:#dc5332">Төрөлт</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->die: 0}}</span><span class="title" style="border-color:#567dcc">Нас баралт</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->inspection: 0}}</span><span class="title" style="border-color:#3d9642">Үзлэг</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->call_near: 0}}</span><span class="title" style="border-color:#ffab2c">Ойрын дуудлага</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->call_remote : 0 }}</span><span class="title" style="border-color:#999">Холын дуудлага</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->ytt: 0}}</span><span class="title" style="border-color:#8959a8">ЯТТусламж</span></div></li>
                        </ul>
                        <div id="hospital_chart_div" style="width: 100%; height: 200px; padding: 0 15px;"></div>
                        <script>
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawVisualization);

                            function drawVisualization() {
                                // Some raw data (not necessarily accurate)
                                var data = google.visualization.arrayToDataTable([
                                    ['Month', 'ЯТТусламж','Холын дуудлага','Ойрын дуудлага', 'Үзлэг', 'Нас баралт', 'Төрөлт'],
                                        @foreach($hospitalChart as $hh)
                                    ['{{$hh->month}} сарын {{$hh->day}}',{{(int)$hh->ytt}},{{(int)$hh->call_remote}},{{(int)$hh->call_near}},{{(int)$hh->inspection}},{{(int)$hh->die}},{{(int)$hh->birth}}],
                                    @endforeach
                                ]);

                                var options = {
                                    colors:['#ffab2c','#3d9642','#567dcc','#dc5332','#999','#8959a8'],
                                    chartArea:{left:20,top:10,width:'100%',height:'75%'},
                                    legend:'none',
                                    isStacked: true,
                                    vAxis: {textColor: '#999',gridlines:{color:'#333'},minorGridlines:{color:'#444'}},
                                    hAxis: {textColor: '#999'},
                                    seriesType: 'bars',
                                    series: {4: {type: 'line'}},
                                    animation:{duration:'650',easing:'Out',startup:true},
                                    backgroundColor:'transparent'
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('hospital_chart_div'));
                                chart.draw(data, options);
                            }
                        </script>
                    </div>
                </div>
                <div class="col-sm-6 p-sm-0">
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/police.png')}}"/> <span>Цагдаагийн газар</span></h1>
                        <div class="row">
                            <div class="col-sm-6 pr-sm-0">
                                <h6 style="padding: 0 15px;text-transform: uppercase;color: #ff7900;text-align: right;margin: 0 0 -13px;">Гэмт хэрэг</h6>
                                <ul class="grid-list-item clearfix">
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->crime_kill: 0}}</span><span class="title" style="border-color:#dc5332">Хүн амь</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->crime_theft: 0}}</span><span class="title" style="border-color:#567dcc">Хулгай</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->crime_movement: 0}}</span><span class="title" style="border-color:#3d9642">Хөдөлгөөний аюулгүй байдал</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->crime_other: 0}}</span><span class="title" style="border-color:#ffab2c">Бусад</span></div></li>
                                </ul>
                                <div id="policee1_chart_div" style="width: 100%; height: 200px; padding: 0 15px;"></div>
                                <script>
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawVisualization);

                                    function drawVisualization() {
                                        // Some raw data (not necessarily accurate)
                                        var data = google.visualization.arrayToDataTable([
                                            ['Month', 'Бусад', 'Хөдөлгөөний аюулгүй байдал', 'Хулгай', 'Хүн амь'],
                                            @foreach($policeChart as $pp)
                                            ['{{$pp->month}} сарын {{$pp->day}}',{{(int)$pp->crime_other}},{{(int)$pp->crime_movement}},{{(int)$pp->crime_theft}}, {{(int)$pp->crime_kill}}],
                                            @endforeach
                                        ]);

                                        var options = {
                                            colors:['#ffab2c','#3d9642','#567dcc','#dc5332'],
                                            chartArea:{left:20,top:10,width:'100%',height:'75%'},
                                            legend:'none',
                                            isStacked: true,
                                            vAxis: {textColor: '#999',gridlines:{color:'#333'},minorGridlines:{color:'#444'}},
                                            hAxis: {textColor: '#999'},
                                            seriesType: 'bars',
                                            series: {4: {type: 'line'}},
                                            animation:{duration:'650',easing:'Out',startup:true},
                                            backgroundColor:'transparent'
                                        };

                                        var chart = new google.visualization.ComboChart(document.getElementById('policee1_chart_div'));
                                        chart.draw(data, options);
                                    }
                                </script>
                            </div>
                            <div class="col-sm-6 pl-sm-0">
                                <h6 style="padding: 0 15px;text-transform: uppercase;color: #ff7900;text-align: right;margin: 0 0 -13px;">Захиргааны зөрчил</h6>
                                <ul class="grid-list-item clearfix">
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_family: 0}}</span><span class="title" style="border-color:#dc5332">Гэр бүрлийн хүчирхийлэл</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_healing: 0}}</span><span class="title" style="border-color:#567dcc">Эрүүлжүүлэх</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_arrest: 0}}</span><span class="title" style="border-color:#3d9642">Баривчлагдсан</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_fine: 0}}</span><span class="title" style="border-color:#ffab2c">Торгууль</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_other: 0}}</span><span class="title" style="border-color:#999">Бусад</span></div></li>
                                </ul>
                                <div id="policee2_chart_div" style="width: 100%; height: 200px; padding: 0 15px;"></div>
                                <script>
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawVisualization);

                                    function drawVisualization() {
                                        // Some raw data (not necessarily accurate)
                                        var data = google.visualization.arrayToDataTable([
                                            ['Month','Бусад', 'Торгууль', 'Баривчлагдсан','Эрүүлжүүлэх', 'Гэр бүрлийн хүчирхийлэл'],
                                                @foreach($policeChart as $p)
                                            ['{{$p->month}} сарын {{$p->day}}',{{(int)$p->ac_other}},{{(int)$p->ac_fine}},{{(int)$p->ac_arrest}},{{(int)$p->ac_healing}}, {{(int)$p->ac_family}}],
                                            @endforeach
                                        ]);

                                        var options = {
                                            colors:['#999','#ffab2c','#3d9642','#567dcc','#dc5332'],
                                            chartArea:{left:20,top:10,width:'100%',height:'75%'},
                                            legend:'none',
                                            isStacked: true,
                                            vAxis: {textColor: '#999',gridlines:{color:'#333'},minorGridlines:{color:'#444'}},
                                            hAxis: {textColor: '#999'},
                                            seriesType: 'bars',
                                            series: {5: {type: 'line'}},
                                            animation:{duration:'650',easing:'Out',startup:true},
                                            backgroundColor:'transparent'
                                        };

                                        var chart = new google.visualization.ComboChart(document.getElementById('policee2_chart_div'));
                                        chart.draw(data, options);
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/emergency.png')}}"/> <span>Онцгой байдлын газар</span></h1>
                        <ul class="grid-list-item clearfix">
                            <li><div class="item"><span class="num">{{$n!=null ?$n->fo: 0}}</span><span class="title" style="border-color:#dc5332">Ойн хээрийн түймэр</span></div></li>
                            <li><div class="item"><span class="num">{{$n!=null ?$n->ff: 0}}</span><span class="title" style="border-color:#567dcc">Ообъектын түймэр</span></div></li>
                            <li><div class="item"><span class="num">{{$n!=null ?$n->sos: 0}}</span><span class="title" style="border-color:#3d9642">Аюул ослын дуудлага</span></div></li>
                            <li><div class="item"><span class="num">{{(int)$n->sos+(int)$n->ff+(int)$n->fo}}</span><span class="title" style="border-color:#ffab2c">Нийт дуудлага</span></div></li>
                        </ul>
                        <div id="nemas_chart_div" style="width: 100%; height: 200px; padding: 0 15px;"></div>
                        <script>
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawVisualization);

                            function drawVisualization() {
                                // Some raw data (not necessarily accurate)
                                var data = google.visualization.arrayToDataTable([
                                    ['Month', 'Аюул ослын дуудлага', 'Ообъектын түймэр','Ойн хээрийн түймэр'],
                                        @foreach($nemaChart as $nn)
                                    ['{{$p->month}} сарын {{$nn->day}}',{{(int)$nn->sos}},{{(int)$nn->ff}}, {{(int)$nn->fo}}],
                                    @endforeach
                                ]);

                                var options = {
                                    colors:['#3d9642','#567dcc','#dc5332'],
                                    chartArea:{left:20,top:10,width:'100%',height:'75%'},
                                    legend:'none',
                                    isStacked: true,
                                    vAxis: {textColor: '#999',gridlines:{color:'#333'},minorGridlines:{color:'#444'}},
                                    hAxis: {textColor: '#999'},
                                    seriesType: 'bars',
                                    series: {5: {type: 'line'}},
                                    animation:{duration:'650',easing:'Out',startup:true},
                                    backgroundColor:'transparent'
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('nemas_chart_div'));
                                chart.draw(data, options);
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    @if($events)
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/finance_full.png')}}"/> <span>Эвент</span></h1>
                        @foreach($events as $event)
                            <div class="event_list">
                                <div class="row">
                                <div class="col-sm-1"><i class="fa fa-check"></i></div>
                                <div class="col-sm-9">
                                <div class="desc">{{$event->description}}</div>
                                <div class="where"></div>
                                </div>
                                <div class="col-sm-2">
                                        <div class="date">{{$event->schedule_date}}</div>
                                        <div class="time">{{$event->start_time}}</div>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="col-sm-6 p-sm-0">
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/finance_full.png')}}"/> <span>Төсөв, санхүү</span></h1>
                            <div id="tosovchart" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $i=1; ?>
                                    @foreach($budgets as $budget)
                                        @if($i==1 || $i==3)
                                            <div class="carousel-item @if($i==1) active @endif">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        @endif
                                                        <div style="width:100%;height: 200px;" id="tusuvchart_{{$budget->id}}"></div>
                                                        <script type="text/javascript">
                                                            google.charts.load("current", {packages:["corechart"]});
                                                            google.charts.setOnLoadCallback(drawChart_{{$budget->id}});
                                                            function drawChart_{{$budget->id}}() {
                                                                var data_{{$budget->id}} = google.visualization.arrayToDataTable([
                                                                    ['Tesk', 'Amount'],
                                                                    ['Өссөн /сар/', {{$budget->monthUp}}],
                                                                    ['Үлдэгдэл',  {{$budget->b_do}}],
                                                                    ['Хийгдсэн', {{$budget->b_done}}],
                                                                    ['Гүйцэтгэл', {{$budget->b_doing}}]

                                                                ]);
                                                                var options_{{$budget->id}} = {
                                                                    legend: 'none',
                                                                    is3D:'true',
                                                                    chartArea: {
                                                                        left:0,
                                                                        top:0,
                                                                        width:'100%',
                                                                        height:'100%'
                                                                    },
                                                                    width:'100%',
                                                                    slices: {
                                                                        0: { color: '#ffab2c'},
                                                                        1: { color: '#dc5332' ,offset: '0.05'},
                                                                        2: { color: '#3d9642' ,offset: '0.05'},
                                                                        3: { color: '#567dcc' ,offset: '0.05'}
                                                                    },
                                                                    backgroundColor:'transparent'
                                                                };

                                                                var chart_{{$budget->id}} = new google.visualization.PieChart(document.getElementById('tusuvchart_{{$budget->id}}'));
                                                                chart_{{$budget->id}}.draw(data_{{$budget->id}}, options_{{$budget->id}});
                                                            }
                                                        </script>
                                                        @if($i==1 || $i==3)
                                                    </div>
                                                    <div class="col-sm-6">
                                                        @endif
                                                        @if($i==2 || $i==4)
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <?php $i++; ?>
                                    @endforeach
                                </div>
                            </div>
                            @if($budgets)
                                <div style="padding: 0 15px 15px;">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        @foreach($budgets as $budget)
                                            @if($budget->b_type==1)
                                                <th scope="col">Улсын</th>
                                            @elseif($budget->b_type==2)
                                                <th scope="col">ОНХС</th>
                                            @elseif($budget->b_type==3)
                                                <th scope="col">Замын сан</th>
                                            @elseif($budget->b_type==4)
                                                <th scope="col">ЗД-ын нөөц</th>
                                            @endif
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr style="color: #ccc;">
                                        <th scope="row">Батлагдсан /жил/</th>
                                        @foreach($budgets as $budget)
                                            <td>{{$budget->b_approved}}</td>
                                        @endforeach
                                    </tr>
                                    <tr style="color: #ffab2c;"><th scope="row">Өссөн /сар/</th>
                                        @foreach($budgets as $budget)
                                            <td>{{$budget->monthUp}}</td>
                                        @endforeach
                                    </tr>
                                    <tr style="color: #567dcc;"><th scope="row">Гүйцэтгэл</th>
                                        @foreach($budgets as $budget)
                                            <td>{{$budget->b_doing}}</td>
                                        @endforeach
                                    </tr>
                                    <tr style="color:#3d9642;"><th scope="row">Хийгдсэн</th>
                                        @foreach($budgets as $budget)
                                            <td>{{$budget->b_done}}</td>
                                        @endforeach</tr>
                                    <tr style="color:#dc5332;"><th scope="row">Үлдэгдэл</th>
                                        @foreach($budgets as $budget)
                                            <td>{{$budget->b_do}}</td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            @endif
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </body>
</html>
