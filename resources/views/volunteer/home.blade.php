@extends('volunteer.body')
@section('meta')
    <title>Volunteer | Сайн дурынхан</title>
    <meta name="title" content="Volunteer | Сайн дурынхан">
    <meta name="keywords" content="Volunteer | Сайн дурынхан">
    <meta name="description" content="Volunteer | Сайн дурынхан">
@endsection
@section('content')
    <div id="VolunteerSlide" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#VolunteerSlide" data-slide-to="0" class="active"></li>
            <li data-target="#VolunteerSlide" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('{{asset("main/volunteer/images/slide/001.jpg")}}');">
                <div class="container pt-5 pb-5">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="position-relative descip">
                            <h4>Мод тарих өдөр - 2019</h4>
                            <div class="intro">Энэ өдөр бүх нийтээрээ Дэлхийн уур амьсгалын төлөө мод тарих САЙН ӨДӨР юи. Та бүхэн өргөнөөр оролцохыг хүсэж байна.</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="text-uppercase nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Хувь хүн</a>
                                </li>
                                <li class="nav-item">
                                    <a class="text-uppercase nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Байгууллага</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form method="post" action="{{asset("userResiter")}}" enctype="multipart/form-data" class="registerForum border border-top-0 rounded-bottom">
                                <div class="form-group">
                                    <label>И-мэйл хаяг:</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Утасны дугаар:</label>
                                    <input type="number" name="cellPhone" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Нууц үг:</label>
                                    <input type="text" name="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Бүртгүүлэх</button>
                                <div class="registerOr"><span>эсвэл</span></div>
                                <button type="button" class="facebookBTN"><i class="fab fa-facebook-square"></i> Файсбүүк</button>
                            </form>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form method="post" action="{{asset("organizationResiter")}}" enctype="multipart/form-data" class="registerForum border border-top-0 rounded-bottom">
                                    <div class="form-group">
                                        <label>И-мэйл хаяг:</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Утасны дугаар:</label>
                                        <input type="number" name="cellPhone" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Нууц үг:</label>
                                        <input type="text" name="password" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Бүртгүүлэх</button>
                                    <div class="registerOr"><span>эсвэл</span></div>
                                    <button type="button" class="facebookBTN"><i class="fab fa-facebook-square"></i> Файсбүүк</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('{{asset("main/volunteer/images/slide/002.jpg")}}');">
                <div class="container pt-5 pb-5">
                    <div class="row">
                        <div class="col-sm-8"></div>
                        <div class="col-sm-4">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="text-uppercase nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Хувь хүн</a>
                                </li>
                                <li class="nav-item">
                                    <a class="text-uppercase nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Байгууллага</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <form method="post" action="{{asset("userResiter")}}" enctype="multipart/form-data" class="registerForum border border-top-0 rounded-bottom">
                                        <div class="form-group">
                                            <label>И-мэйл хаяг:</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Утасны дугаар:</label>
                                            <input type="number" name="cellPhone" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Нууц үг:</label>
                                            <input type="text" name="password" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Бүртгүүлэх</button>
                                        <div class="registerOr"><span>эсвэл</span></div>
                                        <button type="button" class="facebookBTN"><i class="fab fa-facebook-square"></i> Файсбүүк</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <form method="post" action="{{asset("organizationResiter")}}" enctype="multipart/form-data" class="registerForum border border-top-0 rounded-bottom">
                                        <div class="form-group">
                                            <label>И-мэйл хаяг:</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Утасны дугаар:</label>
                                            <input type="number" name="cellPhone" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Нууц үг:</label>
                                            <input type="text" name="password" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Бүртгүүлэх</button>
                                        <div class="registerOr"><span>эсвэл</span></div>
                                        <button type="button" class="facebookBTN"><i class="fab fa-facebook-square"></i> Файсбүүк</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection