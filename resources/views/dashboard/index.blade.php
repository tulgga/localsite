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
    <link href="{{ asset('/dashboard/index.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="d_n">
    <div class="d_nt"> Удирдлагын нэгтгэсэн мэдээ: {{$yesterday}} </div>
</div>

<div class="col-sm-12">
    <div class='row c_m'>
        <div class='col-sm-3'>
            <div class="c">
                <div class="c_t"> Цагдаагийн газар </div>
                <div class="c_b">
                    <p class="row c_bt"> Гэмт хэрэг </p>
                    <p class="row c_i">
                        <b class="c_ik"> Хүн амь </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Хулгай </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Хөдөлгөөний аюулгүй байдал </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Бусад </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_bt"> Захиргааны зөрчил </p>
                    <p class="row c_i">
                        <b class="c_ik"> Гэр бүрлийн хүчирхийлэл </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Эрүүлжүүлэх </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Баривчлагдсан </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Торгууль </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Бусад </b><b class="c_iv"> 0 </b>
                    </p>
                </div>
            </div>
        </div>

        <div class='col-sm-2'>
            <div class="c">
                <div class="c_t"> Эрүүл мэндийн төв </div>
                <div class="c_b">
                    <p class="row c_i">
                        <b class="c_ik"> Төрсөн </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Нас барсан </b><b class="c_iv"> 0 </b>
                    </p>



                    <p class="row c_i">
                        <b class="c_ik"> Урьдчилан сэргийлэх үзлэг </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Хэвтэн эмчлүүлэгч </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Яаралтай тусламжийн төвөөр </b><b class="c_iv"> 0 </b>
                    </p>


                    <p class="row c_bt"> Дуудлага </p>
                    <p class="row c_i">
                        <b class="c_ik"> Ойрын </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> Холын </b><b class="c_iv"> 0 </b>
                    </p>
                </div>
            </div>
        </div>

        <div class='col-sm-2'>
            <div class="c">
                <div class="c_t"> Онцгой байдлын газар </div>
                <div class="c_b">
                    <p class="row c_bt"> Түймэр </p>
                    <p class="row c_i">
                        <b class="c_ik"> Ойн хээрийн </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> объектын </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> зөрчил </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_bt"> Аюул үзэгдэл, ослын дуудлага </p>
                    <p class="row c_i">
                        <b class="c_ik"> тоо </b><b class="c_iv"> 0 </b>
                    </p>

                    <p class="row c_i">
                        <b class="c_ik"> тайлбар </b>
                    </p>
                </div>
            </div>
        </div>

        <div class='col-sm-5'>
            <div class="c">
                <div class="c_t"> Төсөв </div>
                <div class="c_b">
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
                        <tr>
                            <th scope="row">Улсын</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th scope="row">ОНХС</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th scope="row">Замын сан</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th scope="row">ЗД-ын нөөц</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class='row c_m'>
        <div class='col-sm-3'>
            <div class="c">
                <div class="c_t"> Өнөөдөр болох үйл ажиллагаанууд </div>
                <div class="c_b">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class='row'>
                                    <div class='col-sm' id='item1'>
                                        <h3>I am </h3>
                                        <p>#F0386B</p>
                                    </div>
                                    <div class='col-sm'  id='item2'>
                                        <h3>I am </h3>
                                        <p>#FF5376</p>
                                    </div>
                                    <div class='col-sm' id='item3'>
                                        <h3>I am </h3>
                                        <p>#9883E5</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class='row'>
                                    <div class='col-sm' id='item4'>
                                        <h3>I am </h3>
                                        <p>#F49F0A</p>
                                    </div>
                                    <div class='col-sm' id='item5'>
                                        <h3>I am </h3>
                                        <p>#EFCA08</p>
                                    </div>
                                    <div class='col-sm' id='item6'>
                                        <h3>I am </h3>
                                        <p>#FFE381</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class='row'>
                                    <div class='col-sm' id='item7'>
                                        <h3>I am </h3>
                                        <p>#8DE4FF</p>
                                    </div>
                                    <div class='col-sm' id='item8'>
                                        <h3>I am </h3>
                                        <p>#8AC4FF</p>
                                    </div>
                                    <div class='col-sm' id='item9'>
                                        <h3>I am </h3>
                                        <p>#90FFDC</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='col-sm-3'>
            <div class="c">
                <div class="c_t"> Ажлын төлөвлөгөө </div>
                <div class="c_b">
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
                        <tr>
                            <th scope="row">Улсын</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th scope="row">ОНХС</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th scope="row">Замын сан</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <th scope="row">ЗД-ын нөөц</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class='col-sm-3'>
            <div class="c">
                <div class="c_t"> Цаг үеийн асуудал </div>
                <div class="c_b">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">хаанаас</th>
                            <th scope="col">огноо</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">Улсын</th>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class='col-sm-3'>
            <div class="c">
                <div class="c_t"> Цагдаагийн газар </div>
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
</body>
</html>



