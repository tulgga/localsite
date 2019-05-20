<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>Нэвтрэх</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('main/dashboard/img/core-img/favicon.ico')}}">
    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="{{ asset('main/dashboard/style.css')}}">

</head>

<body class="vertical-dark">
<!-- Preloader -->
<div id="preloader"></div>

<!-- ======================================
******* Page Wrapper Area Start **********
======================================= -->
<div class="main-content- h-100vh">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-lg-6 mx-auto">
                <!-- Middle Box -->
                <div class="middle-box my-5 text-center bg-white p-4 p-sm-5 bg-boxshadow">
                    <h5 class="mb-50">BAYANKHONGOR DASHBOARD</h5>
                    @if(Session::has('resultMsg'))
                        <div class="alert alert-danger" style="font-size: 14px;color: #ef0000;"> {{ Session::get('resultMsg') }} </div>
                    @endif
                    <form class="login-form" method="post" action="{{asset('loginCheck')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="text" name="user_name" class="form-control login" placeholder="Нэвтрэх эрх" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control login" placeholder="Нууц үг" required="">
                        </div>
                        <button type="submit" class="btn- btn-success btn-1 btn-1c w-100 text-center">нэвтрэх</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('main/dashboard/js/jquery.min.js')}}"></script>
<script src="{{ asset('main/dashboard/js/popper.min.js')}}"></script>
<script src="{{ asset('main/dashboard/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('main/dashboard/js/admetro.bundle.js')}}"></script>
<script src="{{ asset('main/dashboard/js/default-assets/active.js')}}"></script>
</body>
</html>
