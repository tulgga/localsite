<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Loan history</title>

    <style>
        html, body {
            font-size: 14px;
            line-height: 15px;
        }
        body {
            padding: 15px;
        }
        table {
            margin-bottom: 20px;
        }

        h1, h2, h3, h4 {
            margin-top: 0px;
            margin-bottom: 1.5rem;
        }

        p {
            margin-top: 0px;
            margin-bottom: 0px;
        }
    </style>

</head>
<body>
    
    <div>
        <h1 align="center">Зээлийн түүх</h1>
        <table border="0" cellspacing="0" cellpadding="5">
            <tbody>
                <tr>
                    <td>Зээлдэгчийн нэр: {{$info->firstname}}</td>
                </tr>
                <tr>
                    <td>Зээлийн хэмжээ: {{$info->loan_amount}}₮</td>
                </tr>
                <tr>
                    <td>Хугацаа: {{$info->payback_period}} сар</td>
                </tr>
                <tr>
                    <td>Шимтгэл: {{$info->loan_fee}}₮</td>
                </tr>
                <tr>
                    <td>Эргэн төлөх дүн: {{floatval($info->loan_fee) + floatval($info->loan_amount)}}₮</td>
                </tr>
            </tbody>
        </table>
        <table border="1" width="100%" cellspacing="0" cellpadding="10" bordercolor="#cccccc">
            <thead>
                <tr>
                    <th align="left">Төлөв</th>
                    <th align="left">Огноо</th>
                </tr>
            </thead>
            <tbody>
                @foreach($history as $key => $item)
                    @if($item->status === 2)
                        <tr>
                            <td>Зээлийн барьцаа баталгаажсан</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Зээл олгов</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @elseif($item->status === 3)
                        <tr>
                            <td>Эргэн төлөлт баталгаажсан</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Зээл хаав</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @elseif($item->status === 4)
                        <tr>
                            <td>Зээлийн хугацаа хэтэрсэн</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @elseif($item->status === 5)
                        <tr>
                            <td>Зээлийг идэвхигүй болгов</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @elseif($item->status === 6)
                        <tr>
                            <td>Зээлийн хүсэлт цуцлагдав</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @elseif($item->status === 7)
                        <tr>
                            <td>Барьцаа борлуулав</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Зээл хаав</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @elseif($item->status === 8)
                        <tr>
                            <td>Барьцаа буцаав</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @elseif($item->status === 9)
                        <tr>
                            <td>Барьцаа буцаах хүсэлт илгээсэн</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @else
                        <tr>
                            <td>Зээлийн хүсэлт ирсэн</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
