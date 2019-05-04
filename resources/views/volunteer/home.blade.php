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
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="position-relative descip">
                            <h4>Мод тарих өдөр - 2019</h4>
                            <div class="intro">Энэ өдөр бүх нийтээрээ Дэлхийн уур амьсгалын төлөө мод тарих САЙН ӨДӨР юм. Та бүхэн өргөнөөр оролцохыг хүсэж байна.</div>
                            </div>
                        </div>
                        <div class="col-sm-4">

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
                @foreach($events as $event)
                <!--Project Column-->
                <div class="col-sm-3 column project-column">
                    <article class="column-inner hvr-float-shadow">
                        <figure class="image-box">
                            <a href="#"><img src="/uploads/{{$event->event_image[0]['image']}}" title="{{$event->name}}"></a>
                        </figure>
                        <div class="lower-part">
                            <div class="text">
                                <a href="#"><h3>{{$event->subject}}</h3></a>
                                <p>{{strip_tags(substr($event->content,0,200))}}</p>
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
