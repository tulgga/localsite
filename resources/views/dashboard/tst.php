
<div class="h-auto item_cell row">
    <div class="item_cell col-sm-3">
        <div class=" child first">
            <h1 class="title">Эрүүл мэндийн төв - {{$h !=null ? (int)$h->total : 0}}</h1>
            <table class="table">
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

    <div class="h-auto item_cell col-sm-6">
        <div class=" child second ">
            <h1 class="title">Цагдаагийн газар - {{$p !=null ? (int)$p->total : 0}}</h1>
            <div class="item_cell row" style="padding: 5px 10px;">
                <div class='col-sm-6 item_cell'>
                    <p><font color="white" class="float-right">/ Гэмт хэрэг /</font></p>
                    <table class="table">
                        <tbody>
                        <tr><th scope="row">Хүн амь</th><td>{{$p!=null ?$p->crime_kill: 0}}</td></tr>
                        <tr><th scope="row">Хулгай </th><td>{{$p!=null ?$p->crime_theft: 0}}</td></tr>
                        <tr><th scope="row">Хөдөлгөөний аюулгүй байдал </th><td>{{$p!=null ?$p->crime_movement: 0}}</td></tr>
                        <tr><th scope="row">Бусад </th><td>{{$p!=null ?$p->crime_other: 0}}</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class='col-sm-6 item_cell'>
                    <p><font color="white" class="float-right">/Захиргааны зөрчил /</font></p>
                    <table class="table">
                        <tbody>
                        <tr><th scope="row">Гэр бүрлийн хүчирхийлэл </th><td>{{$p!=null ?$p->ac_family: 0}}</td></tr>
                        <tr><th scope="row">Эрүүлжүүлэх</th><td>{{$p!=null ?$p->ac_healing: 0}}</td></tr>
                        <tr><th scope="row">Баривчлагдсан </th><td>{{$p!=null ?$p->ac_arrest: 0}}</td></tr>
                        <tr><th scope="row">Торгууль </th><td>{{$p!=null ?$p->ac_fine: 0}}</td></tr>
                        <tr><th scope="row">Бусад </th><td>{{$p!=null ?$p->ac_other: 0}}</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12">
                </div>
            </div>

        </div>
    </div>

    <div class="h-auto item_cell col-sm-3">
        <div class=" child third">
            <h1 class="title">Онцгой байдлын газар - {{$n !=null ? (int)$n->total : 0}}</h1>
            <table class="table">
                <table class="table">
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
<div class="h-40 item_cell row">
    <div class="h-auto item_cell col-sm-3">
        <div class="child second">
            @if(count($news)>0)
            <h1 class="title"> Цаг үеийн асуудал</h1>
            <div id="carouselNews" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($news as $i)
                    @if($i->id == $news[0]->id)
                    <div class="carousel-item {{$i->id==$news[0]->id ? 'active' : ''}}">
                        <div class='row'>
                            <div class='col-sm' id='item_news_{{$i->id}}'>
                                <h3 class="button_desc">{{$i->desc}} </h3>
                                <button class="button_left">
                                    @if($i->created_type==1)
                                    <p>Цагдаа</p>
                                    @elseif($i->created_type==2)
                                    <p>эрүүл мэнд</p>
                                    @elseif($i->created_type==3)
                                    <p>Онцгой</p>
                                    @else
                                    <p>-</p>
                                    @endif
                                </button>
                                <button class="button_right">
                                    {{$i->created_at}}
                                </button>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="carousel-item">
                        <div class='row'>
                            <div class='col-sm' id='item_news_{{$i->id}}'>
                                <h3 class="button_desc">{{$i->desc}} </h3>
                                <button class="button_left">
                                    @if($i->created_type==1)
                                    <p>Цагдаа</p>
                                    @elseif($i->created_type==2)
                                    <p>эрүүл мэнд</p>
                                    @elseif($i->created_type==3)
                                    <p>Онцгой</p>
                                    @else
                                    <p>-</p>
                                    @endif
                                </button>
                                <button class="button_right">{{$i->created_at}}</button>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="child second">
            <h1 class="title"> ЭВЭНТ</h1>
            @if($t)
            <div id="carouselEvent" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($t as $i)
                    @if($i->id == $t[0]->id)
                    <div class="carousel-item {{$i->id==$t[0]->id ? 'active' : ''}}">
                        <div class='row'>
                            <div class='col-sm' id='item1{{$i->id}}'>
                                <h3 class="button_desc">{{$i->description}} </h3>
                                <button class="button_left">
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
                                </button>
                                <button class="button_right">
                                    {{$i->schedule_date}}
                                </button>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="carousel-item">
                        <div class='row'>
                            <div class='col-sm' id='item1'>
                                <h3 class="button_desc">{{$i->description}} </h3>
                                <button class="button_left">
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
                                </button>
                                <button class="button_right">
                                    {{$i->schedule_date}}
                                </button>
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
        <div class=" child third">
            <h1 class="title">Төсөв</h1>
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
            <table class="table  child first">
                <thead>
                <tr><th colspan="5"></th></tr>
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
                <tr>
                    <th scope="row">Батлагдсан /жил/</th>
                    @foreach($budgets as $budget)
                    <td>{{$budget->b_approved}}</td>
                    @endforeach
                </tr>
                <tr><th scope="row" style="color: #ffab2c;border-left: 3px solid #ffab2c;padding-left: 10px;">Өссөн /сар/</th>
                    @foreach($budgets as $budget)
                    <td>{{$budget->monthUp}}</td>
                    @endforeach
                </tr>
                <tr><th scope="row" style="color:#567dcc;border-left: 3px solid #567dcc;padding-left: 10px;">Гүйцэтгэл</th>
                    @foreach($budgets as $budget)
                    <td>{{$budget->b_doing}}</td>
                    @endforeach
                </tr>
                <tr><th scope="row" style="color:#3d9642;border-left: 3px solid #3d9642;padding-left: 10px;">Хийгдсэн</th>
                    @foreach($budgets as $budget)
                    <td>{{$budget->b_done}}</td>
                    @endforeach</tr>
                <tr><th scope="row" style="color:#dc5332;border-left: 3px solid #dc5332;padding-left: 10px;">Үлдэгдэл</th>
                    @foreach($budgets as $budget)
                    <td>{{$budget->b_do}}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
    <div class="h-auto item_cell col-sm-3">
        <div class=" child first">
            <div><h1 class="title">Цагийн хуваарь</h1></div>
            <div class="row">

                @foreach($owner_schedule as $schedule)
                <table class="table col-sm-6 border_none " >
                    <thead>
                    <tr>
                        <th style="text-align: left; padding: 10px">{{$schedule['date']}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schedule['data'] as $row)
                    <tr>
                        <td>
                            {{$row->start_time}} - {{$row->end_time}} <br/>
                            {{$row->description}}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
