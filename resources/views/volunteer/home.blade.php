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
                            <div class="tab-content bg-white rounded" id="myTabContent" style="border-top-left-radius: 0 !important;">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form method="post" action="{{asset("userRegister")}}" class="registerForum">
                                {{ csrf_field() }}
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
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Бүртгүүлэх</button>
                                <div class="registerOr"><span>эсвэл</span></div>
                                <button type="button" class="facebookBTN"><i class="fab fa-facebook-square"></i> Фэйсбүүк</button>
                            </form>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form method="post" action="{{asset("organizationRegister")}}" class="registerForum">
                                    {{ csrf_field() }}
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
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Бүртгүүлэх</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('{{asset("main/volunteer/images/slide/002.jpg")}}');">
            </div>
        </div>
    </div>
    <!--Four Column / Current Projects-->
    <section class="four-column current-projects no-padd-top">
        <div class="container">
            <div class="sec-title clearfix">
                <h2 class="float-left">Бидний сайн дурын <strong>ажлууд</strong></h2>
                <div class="link float-right font-14"><a href="#"><span class="fa fa-angle-right"></span> Бүгдийг харах</a></div>
            </div>
            <div class="row clearfix">
                @foreach($volunteers as $volun)
                <!--Project Column-->
                <div class="col-sm-3 column project-column">
                    <article class="column-inner hvr-float-shadow">
                        <figure class="image-box">
                            <a href="#"><img src="http://world5.commonsupport.com/html/volunteer/images/resource/{{$volun->images}}" alt="" title="Volunteer"></a>
                        </figure>
                        <div class="lower-part">
                            <div class="text">
                                <a href="#"><h3>{{$volun->name}}</h3></a>
                                <p>{{$volun->intro}}</p>
                            </div>
                            <div class="row font-12">
                                <div class="col-sm-6 border-right">
                                    <a href="#"><i class="far fa-heart"></i> Таалагдлаа</a>
                                </div>
                                <div class="col-sm-6">
                                    <div class="rating-stars float-right">
                                        <ul id='stars'>
                                            <li class='star' title='Муу' data-value='1'><i class='fa fa-star fa-fw'></i></li>
                                            <li class='star' title='Дунд' data-value='2'><i class='fa fa-star fa-fw'></i></li>
                                            <li class='star' title='Сайн' data-value='3'><i class='fa fa-star fa-fw'></i></li>
                                            <li class='star' title='Маш сайн' data-value='4'><i class='fa fa-star fa-fw'></i></li>
                                            <li class='star' title='Гайхалтай' data-value='5'><i class='fa fa-star fa-fw'></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="four-column team-section">
        <div class="container">
            <div class="sec-title">
                <h2>Сайн дурын <strong>бүлгийхэн</strong></h2>
            </div>
            <div class="row clearfix">
                <!--Team Member-->
                <div class="col-md-3 col-sm-6 col-xs-12 column team-member">
                    <article class="column-inner hvr-float-shadow">
                        <figure class="image-box">
                            <a href="#"><img src="http://world5.commonsupport.com/html/volunteer/images/resource/team-1.jpg" alt="" title="Volunteer"></a>
                            <div class="tag-title"><span>Top</span></div>
                            <div class="rating rating-stars">
                                <ul id='stars'>
                                    <li class='star' title='Муу' data-value='1'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Дунд' data-value='2'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Сайн' data-value='3'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Маш сайн' data-value='4'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Гайхалтай' data-value='5'><i class='fa fa-star fa-fw'></i></li>
                                </ul>
                            </div>
                        </figure>
                        <div class="lower-part">
                            <h3>Г.Лхагвасүрэн</h3>
                            <div class="info">
                                <p>
                                    <strong>E-Mail</strong> :
                                    <a href="mailto:johndoe@email.com">johndoe@email.com</a></p>
                            </div>
                            <div class="social-links">
                                <a href="#" class="fab fa-facebook-f"></a>
                                <a href="#" class="fab fa-twitter"></a>
                                <a href="#" class="fab fa-instagram"></a>
                                <a href="#" class="fab fa-google-plus"></a>
                            </div>
                        </div>
                    </article>
                </div>
                <!--Team Member-->
                <div class="col-md-3 col-sm-6 col-xs-12 column team-member">
                    <article class="column-inner hvr-float-shadow">
                        <figure class="image-box">
                            <a href="#"><img src="http://world5.commonsupport.com/html/volunteer/images/resource/team-2.jpg" alt="" title="Volunteer"></a>
                            <div class="rating rating-stars">
                                <ul id='stars'>
                                    <li class='star' title='Муу' data-value='1'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Дунд' data-value='2'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Сайн' data-value='3'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Маш сайн' data-value='4'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Гайхалтай' data-value='5'><i class='fa fa-star fa-fw'></i></li>
                                </ul>
                            </div>
                        </figure>
                        <div class="lower-part">
                            <h3>М.Мөнхтуяа</h3>
                            <div class="info">
                                <p><strong>E-Mail</strong> :
                                    <a href="mailto:johndoe@email.com">johndoe@email.com</a></p>
                            </div>
                            <div class="social-links">
                                <a href="#" class="fab fa-facebook-f"></a>
                                <a href="#" class="fab fa-twitter"></a>
                                <a href="#" class="fab fa-instagram"></a>
                                <a href="#" class="fab fa-google-plus"></a>
                            </div>
                        </div>
                    </article>
                </div>
                <!--Team Member-->
                <div class="col-md-3 col-sm-6 col-xs-12 column team-member">
                    <article class="column-inner hvr-float-shadow">
                        <figure class="image-box">
                            <a href="#"><img src="http://world5.commonsupport.com/html/volunteer/images/resource/team-3.jpg" alt="" title="Volunteer"></a>
                            <div class="rating rating-stars">
                                <ul id='stars'>
                                    <li class='star' title='Муу' data-value='1'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Дунд' data-value='2'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Сайн' data-value='3'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Маш сайн' data-value='4'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Гайхалтай' data-value='5'><i class='fa fa-star fa-fw'></i></li>
                                </ul>
                            </div>
                        </figure>
                        <div class="lower-part">
                            <h3>Б.Ган-Эрдэнэ</h3>
                            <div class="info">
                                <p><strong>E-Mail</strong> :
                                    <a href="mailto:johndoe@email.com">johndoe@email.com</a></p>
                            </div>
                            <div class="social-links">
                                <a href="#" class="fab fa-facebook-f"></a>
                                <a href="#" class="fab fa-twitter"></a>
                                <a href="#" class="fab fa-instagram"></a>
                                <a href="#" class="fab fa-google-plus"></a>
                            </div>
                        </div>
                    </article>
                </div>
                <!--Team Member-->
                <div class="col-md-3 col-sm-6 col-xs-12 column team-member">
                    <article class="column-inner hvr-float-shadow">
                        <figure class="image-box">
                            <a href="#"><img src="http://world5.commonsupport.com/html/volunteer/images/resource/team-4.jpg" alt="" title="Volunteer"></a>
                            <div class="rating rating-stars">
                                <ul id='stars'>
                                    <li class='star' title='Муу' data-value='1'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Дунд' data-value='2'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Сайн' data-value='3'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Маш сайн' data-value='4'><i class='fa fa-star fa-fw'></i></li>
                                    <li class='star' title='Гайхалтай' data-value='5'><i class='fa fa-star fa-fw'></i></li>
                                </ul>
                            </div>
                        </figure>
                        <div class="lower-part">
                            <h3>Анхбаатар</h3>
                            <div class="info">
                                <p><strong>E-Mail</strong> :
                                    <a href="mailto:johndoe@email.com">johndoe@email.com</a></p>
                            </div>
                            <div class="social-links">
                                <a href="#" class="fab fa-facebook-f"></a>
                                <a href="#" class="fab fa-twitter"></a>
                                <a href="#" class="fab fa-instagram"></a>
                                <a href="#" class="fab fa-google-plus"></a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection