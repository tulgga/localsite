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
                            <li><div class="item"><span class="num">{{$h!=null ?$h->birth: 0}}</span><span class="title">Төрөлт</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->die: 0}}</span><span class="title">Нас баралт</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->inspection: 0}}</span><span class="title">Үзлэг</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->call_near: 0}}</span><span class="title">Ойрын дуудлага</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->call_remote : 0 }}</span><span class="title">Холын дуудлага</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->ytt: 0}}</span><span class="title">ЯТТусламж</span></div></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-6 p-sm-0">
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/police.png')}}"/> <span>Цагдаагийн газар</span></h1>
                        <div class="row">
                            <div class="col-sm-6 pr-sm-0">
                                <h6 style="padding: 0 15px;text-transform: uppercase;color: #ff7900;text-align: right;margin: 0 0 -13px;">Гэмт хэрэг</h6>
                                <ul class="grid-list-item clearfix">
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->crime_kill: 0}}</span><span class="title">Хүн амь</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->crime_theft: 0}}</span><span class="title">Хулгай</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->crime_movement: 0}}</span><span class="title">Хөдөлгөөний аюулгүй байдал</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->crime_other: 0}}</span><span class="title">Бусад</span></div></li>
                                </ul>
                                <div id="chart_div" style="width: 100%; height: 200px;"></div>
                                <script>
                                    google.charts.load('current', {'packages':['corechart']});
                                    google.charts.setOnLoadCallback(drawVisualization);

                                    function drawVisualization() {
                                        // Some raw data (not necessarily accurate)
                                        var data = google.visualization.arrayToDataTable([
                                            ['Month', 'Хүн амь', 'Хулгай', 'Хөдөлгөөний аюулгүй байдал', 'Бусад'],
                                            ['2004/05',  165,      938,         522,             998],
                                            ['2005/06',  135,      1120,        599,             1268],
                                            ['2006/07',  157,      1167,        587,             807],
                                            ['2007/08',  139,      1110,        615,             968],
                                            ['2008/09',  136,      691,         629,             1026]
                                        ]);

                                        var options = {
                                            legend:'none',
                                            title : 'Monthly Coffee Production by Country',
                                            isStacked: true,
                                            vAxis: {title: 'Cups'},
                                            hAxis: {title: 'Month'},
                                            seriesType: 'bars',
                                            series: {5: {type: 'line'}},
                                            backgroundColor:'transparent'
                                        };

                                        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                                        chart.draw(data, options);
                                    }
                                </script>
                            </div>
                            <div class="col-sm-6 pl-sm-0">
                                <h6 style="padding: 0 15px;text-transform: uppercase;color: #ff7900;text-align: right;margin: 0 0 -13px;">Захиргааны зөрчил</h6>
                                <ul class="grid-list-item clearfix">
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_family: 0}}</span><span class="title">Гэр бүрлийн хүчирхийлэл</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_healing: 0}}</span><span class="title">Эрүүлжүүлэх</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_arrest: 0}}</span><span class="title">Баривчлагдсан</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_fine: 0}}</span><span class="title">Торгууль</span></div></li>
                                    <li><div class="item"><span class="num">{{$p!=null ?$p->ac_other: 0}}</span><span class="title">Бусад</span></div></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/emergency.png')}}"/> <span>Онцгой байдлын газар</span></h1>
                        <ul class="grid-list-item clearfix">
                            <li><div class="item"><span class="num">{{$n!=null ?$n->fo: 0}}</span><span class="title">Ойн хээрийн түймэр</span></div></li>
                            <li><div class="item"><span class="num">{{$n!=null ?$n->ff: 0}}</span><span class="title">Ообъектын түймэр</span></div></li>
                            <li><div class="item"><span class="num">{{$n!=null ?$n->sos: 0}}</span><span class="title">Аюул ослын дуудлага</span></div></li>
                            <li><div class="item"><span class="num">{{$n !=null ? (int)$n->total : 0}}</span><span class="title">Нийт дуудлага</span></div></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 p-sm-0">
                    <div class="box" style="padding: 15px;">
                        <h1 class="title"><span>Төсөв, санхүү</span></h1>
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
                            @endif
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </body>
</html>
