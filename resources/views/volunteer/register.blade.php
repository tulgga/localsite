@extends('volunteer.body')
@section('meta')
    <title>Бүртгүүлэх</title>
    <meta name="title" content="Volunteer | Сайн дурынхан">
    <meta name="keywords" content="Volunteer | Сайн дурынхан">
    <meta name="description" content="Volunteer | Сайн дурынхан">
@endsection
@section('content')
    <div class="container pt-5 pb-5">
        @if(Session::has('successMsg'))
            <div class="alert alert-success font-14"> {{ Session::get('successMsg') }} <a href="{{asset('login') }}" data-toggle="modal" data-target="#LoginForm">Нэвтрэх</a> </div>
        @endif
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h3 class="head mb-3">Бүртгэлийн <strong>хэсэг</strong></h3>
                <form class="font-14" method="post" action="{{asset("userRegister")}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input value="{{ Session::get('name') }}" type="text" placeholder="Нэвтрэх нэр" name="name" class="form-control" required>
                        @if(Session::has('nameerror'))<font class="font-12" color="red">{{str_replace('The name has already been taken','Нэвтрэх нэр бүртгэгдсэн байна',Session::get('nameerror'))}}</font>@endif
                    </div>
                    <div class="form-group">
                        <input value="{{ Session::get('lastname') }}" type="text" placeholder="Овог" name="lastname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input value="{{ Session::get('firstname') }}" type="text" placeholder="Нэр" name="firstname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input pattern="[А-Яа-яӨөҮү]{2}[0-9]{8}" value="{{ Session::get('registration_no') }}" type="text" maxlength="10" id="register" placeholder="Регистрийн дугаар" name="registration_no" class="form-control" required>
                        <span class="font-12 msg font-italic"><font color="#a9a9a9">Крилл үсгээр бичнэ үү</font></span>
                    </div>
                    <div class="form-group">
                        <select name="site_id" class="form-control" required>
                            <option value=""> Сум сонгох </option>
                            <?php foreach($site as $st){ ?>
                            <option value="<?php echo $st->id; ?>" @if(Session::get('site_id') == $st->id) selected @endif><?php echo $st->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input value="{{ Session::get('email') }}" type="email" placeholder="И-мэйл хаяг" name="email" class="form-control" required>
                        @if(Session::has('emailerror'))<font class="font-12" color="red">{{str_replace('The email has already been taken','Имэйл хаяг бүртгэгдсэн байна',Session::get('emailerror'))}}</font>@endif
                    </div>
                    <div class="form-group">
                        <input value="{{ Session::get('phone') }}" type="number" placeholder="Утасны дугаар" name="phone" class="form-control" required>
                        @if(Session::has('phoneerror'))<font class="font-12" color="red">{{str_replace('The phone has already been taken','Утасны дугаар бүртгэгдсэн байна',Session::get('phoneerror'))}}</font>@endif
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Нууц үг" name="password" class="form-control form" required>
                        @if(Session::has('passworderror'))<font class="font-12" color="red">{{str_replace('The password must be at least 6 characters','Нууц үг хамгийн багадаа 6 тэмдэгрт байна',Session::get('passworderror'))}}</font>@endif
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Нууц үг давтах" name="verify_password" class="form-control" required>
                        @if(Session::has('verify_password'))<font class="font-12" color="red">{{str_replace('The verify password and password must match','Нууц үг тохирсонгүй',Session::get('verify_password'))}}</font>@endif
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="servicecondition" name="servicecondition" required>
                        Би <a href="#" data-toggle="modal" data-target=".service_condition">үйлчилгээний нөхцөлийг</a> зөвшөөрч байна.
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Бүртгүүлэх</button>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>

    </div>
    <div class="modal fade service_condition" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold" id="exampleModalLabel">Үйлчилгээний нөхцөлтэй танилцана уу</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="rounded service_conditions bg-white mb-3 p-3 overflow-auto font-14">

                        <h6 class="font-weight-bold">
                            1. ЕРӨНХИЙ ЗААЛТ</h6>
                        <ol>
                            <li>
                                www.skytel.mn нь Скайтел компанийн интернэт худалдааны албан ёсны вэбсайт бөгөөд энэхүү нөхцөл, журам нь уг вэбсайтаар үйлчлүүлэх, худалдан авалт хийхтэй холбоотой үүсэх харилцааг зохицуулахад оршино.</li>
                            <li>
                                Энэхүү нөхцөл нь хэрэглэгч худалдан авалт хийх, вэбсайтаар үйлчлүүлэхээсээ өмнө хүлээн зөвшөөрч баталгаажуулсаны үндсэн дээр хэрэгжинэ.</li>
                            <li>
                                Энэхүү үйлчилгээний нөхцлийн хэрэгжилтэнд Скайтел ХХК /цаашид байгууллага гэх/ болон хэрэглэгч /цаашид хэрэглэгч гэх/ хамтран хяналт тавина.</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            2. ВЭБСАЙТ БА ТҮҮНИЙ ҮЙЛ АЖИЛЛАГАА</h6>
                        <ol>
                            <li>
                                www.skytel.mn худалдааны тэмдэгтүүд нь Скайтел ХХК-ийн өмч бөгөөд энэхүү вэб сайтын лого, нэр бусад загварыг хуулах, олшруулах, дуурайх, өөр бусад ямар ч зүйлд ашиглахыг хориглоно.</li>
                            <li>
                                Вэбсайтын мэдээ, үнийн шинэчлэл, урамшуулал болон шинэ үйлчилгээний мэдээлэл зэрэг нь бусад салбарууд дахь мэдээллээс зөрүүтэй байгаа тохиолдолд бусад салбаруудын мэдээллийг үнэн зөвд тооцно.</li>
                            <li>
                                Хэрэглэгч вэбсайтын талаар санал гомдол, шинэ санаа, шинэ бараа борлуулах хүсэлт, шүүмж зэргийг вэбийн журмын дагуу чөлөөтэй илэрхийлэх, илгээх эрхтэй.</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            3. ВЭБСАЙТЫН ХЭРЭГЛЭГЧ БА ГИШҮҮНЧЛЭЛ</h6>
                        <ol>
                            <li>
                                Вэбсайт нь гишүүнчлэлтэй байна. Вэбээр үйлчлүүлэх буюу худалдан авалт хийхийг хүссэн ямар ч хэрэглэгч вэбийн гишүүн байх ёстой.</li>
                            <li>
                                Гишүүний мэдээллийн бүрэн бүтэн болон үнэн зөв байдлыг байгууллага цаг тухай бүрт шалгаж байх ба эдгээр мэдээлэл нууц байж, нууцлалыг байгууллага бүрэн хариуцна</li>
                            <li>
                                Хэрэглэгчийн мэдээллийн үнэн зөв, бодит байдалд хэрэглэгч бүрэн хариуцлага хүлээнэ.</li>
                            <li>
                                Нэг хэрэглэгч нэг л э-мэйл хаягаар гишүүн болох эрхтэй. Ашиглагдсан имэйл хаяг дахин өөр гишүүнчлэлд ашиглагдахгүй.</li>
                            <li>
                                Шинээр бүртгүүлж вэбийн гишүүн болмогц тухайн хэрэглэгчид данс үүснэ. Дансанд худалдан авалтын түүх, өөрийн мэдээлэл, хүргэлтийн хаяг, хуримтлагдсан бонус зэрэг багтах бөгөөд картын ямар ч мэдээлэл хадгалагдахгүй.</li>
                            <li>
                                Хэрэв хэрэглэгч худал эсвэл буруу мэдээлэл оруулах, гишүүнийхээ үүргийг биелүүлээгүй зэрэгт тухайн гишүүний дансыг хаана.</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            4. ИНТЕРНЕТ ХУДАЛДАА</h6>
                        <ol>
                            <li>
                                www.skytel.mn вэбсайт интернетээр дамжуулан Скайтал компанийн үндсэн бүтээгдэхүүн үйлчилгээ, Скайтел группын охин компаниудын бүтээгдэхүүн үйлчилгээг худалдаална</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            5. УРЬДЧИЛСАН ТӨЛБӨРТ ҮЙЛЧИЛГЭЭНИЙ ШИНЭ ДУГААРЫН ХУДАЛДАА</h6>
                        <ol>
                            <li>
                                Хэрэглэгч вэбсайтад байрлах байнгын шинэ дугааруудаас худалдан авах боломжтой.</li>
                            <li>
                                Хэрэглэгч сонгосон дугаараа сагсандаа хийснээс хойш 30 минутын дотор худалдан авалт хийх буюу төлбөрөө төлөх ёстой. Худалдан авалт буюу төлбөр төлөгдөөгүй тохиолдолд тухайн дугаарыг өөр хэрэглэгч худалдан авах боломжтой байна.</li>
                            <li>
                                Дугаараа очиж авахдаа өөрийн бүртгүүлсэн мэдээллийн дагуу иргэний үнэмлэхтэйгээ очиж авна.</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            7. УРЬДЧИЛСАН ТӨЛБӨРТ ЦЭНЭГЛЭГЧ КАРТЫН ХУДАЛДАА</h6>
                        <ol>
                            <li>
                                Худалдан авалт хийгдмэгц цэнэглэгч картын нууц дугаар 30 секундэнд багтан дэлгэцэн дээр гарч ирэх ба худалдан авагчид кодыг баталгаажуулах имэйл илгээгдэнэ.</li>
                            <li>
                                Эсвэл өөрийн нэгж авахыг хүсэж буй дугаарыг вэб сайтад хийснээр уг дугаарыг сонгосон нэгжээр шууд цэнэглэнэ.</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            8. ДАРАА ТӨЛБӨРТ ХЭРЭГЛЭГЧИЙН УТАСНЫ ТӨЛБӨР ТӨЛӨЛТ</h6>
                        <ol>
                            <li>
                                Утас нь хаагдсан хэрэглэгч төлбөрөө бүтэн төлсөн нөхцөлд үйлчилгээний эрх&nbsp; сэргээгдэх бөгөөд сар бүрийн 20-с өмнө төлбөрөө төлсөн хэрэглэгч 5% ийн хөнгөлөлтөд хамрагдах эрхтэй болно. 5%-ийн хөнгөлөлт нь дараа сарын ярианы төлбөр дээр хасагдаж тооцогдоно.</li>
                            <li>
                                Хаагдсан дугаарын эрхийг 24 цагийн турш нээх бөгөөд хэрэглэгч төлбөрөө хийснээс хойш 30 минутын дотор сэргээгдэнэ.</li>
                            <li>
                                Хэрэв утасны төлбөр нийт дүнд хүрэхгүй бол вэб оператор е-майлээр эсвэл утсаар хэрэглэгчид мэдэгдэж, үлдэгдэл төлбөрөө төлөхийг сануулж болно.</li>
                        </ol>

                        <h6 class="font-weight-bold">
                            9. ГАР УТАС БОЛОН БУСАД БАРАА БҮТЭЭГДЭХҮҮНИЙ ХУДАЛДАА</h6>
                        <ol>
                            <li>
                                Гар утас болон бусад бараа бүтээгдэхүүнд дараах ангилалд хуваагдана.
                                <ul>
                                    <li>
                                        Гар утас</li>
                                    <li>
                                        Модем</li>
                                    <li>
                                        Таблет</li>
                                    <li>
                                        Бусад электрон бараа</li>
                                </ul>
                            </li>
                            <li>
                                Вэб сайтаар худалдан авсан төхөөрөмжүүд нь үйлчилгээний салбаруудаар зарагдаж буй нөхцөлтэй ижил буюу түүнээс илүү давуу нөхцөлтэй байна.</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            10. ҮНЭ, ТӨЛБӨР ТООЦОО</h6>
                        <ol>
                            <li>
                                Барааны үнэ тогтмол шинэчлэгдэж байх ба барааны үнэ дараах байдлаар худалдаалагдана.
                                <ul>
                                    <li>
                                        Нийлүүлэгч байгууллагын бараа - тухайн нийлүүлэгч байгууллагын бусад салбар дэлгүүрүүдийн үнэтэй ижил үнээр борлуулагдана.</li>
                                    <li>
                                        Компанийн болон групп компанийн бараа - үндсэн үнээр борлуулагдана.</li>
                                </ul>
                            </li>
                        </ol>


                        <h6 class="font-weight-bold">
                            11. ВЭБСАЙТЫН ЦАГИЙН ХУВААРЬ</h6>
                        <ol>
                            <li>
                                Вэбсайтын ажиллагаа: 24 цаг</li>
                            <li>
                                Бүх төрлийн цэнэглэгч картын худалдаа: 24 цаг</li>
                            <li>
                                Шинэ дугаарын худалдаа: 09.00 &ndash; 18.00</li>
                            <li>
                                Утасны төлбөр төлөлт: 24 цаг</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            12. БАРИМТЖУУЛАЛТ</h6>
                        <ol>
                            <li>
                                Бүх гүйлгээ, шилжүүлэг, бараа түгээлтийг байгууллагын санхүүгийн тамга бүхий баримтан дээр үндэслэнэ.</li>
                            <li>
                                Худалдан авагч барааг санхүүгийн тамга бүхий баримтын хамт хүлээн авна.</li>
                            <li>
                                Баримт нь бараа бүтээгдэхүүний худалдан авалт хийсэн цорын ганц баталгаа болно.</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            13. БАРАА БУЦААХ НӨХЦӨЛ</h6>
                        <ol>
                            <li>
                                Хэрэглэгч худалдан авсан бараагаа огт авахгүй буцаах үед барааны үнийн нийлбэр дүнгийн 10% хувийг суутгана.</li>
                            <li>
                                Худалдан авсан бараагаа ижил төрлийн бүтээгдэхүүнээр солих боломжтой ба дахин хүргэлтийн зардалыг хэрэглэгч нэмж төлнө.&nbsp;</li>
                            <li>
                                Худалдан авагч барааг хүлээн авсанаас хойш 24 цагийн дотор дээрх 2 заалтын дагуу барааг буцаах буюу солиулах боломжтой.</li>
                        </ol>


                        <h6 class="font-weight-bold">
                            14. БУСАД ЗААЛТ</h6>
                        <ol>
                            <li>
                                Худалдан авагчийн мэдээлэл болон төлбөрийн талаар ямар нэг асуудал эсвэл тодруулга гарвал вэб оператор хэрэглэгчийн утас эсвэл e-майл рүү холбогдож лавлагаа хийж болно.</li>
                            <li>
                                Худалдан авагч худалдан авсан бараа нь төсөөлж байснаас өөр, сэтгэл ханамжгүй байвал барааг зөвхөн 24 цагийн дотор буцаах эрхтэй.</li>
                            <li>
                                Хэрэглэгчээс гарсан гомдол, маргаантай асуудлыг вэбсайтын үйлчилгээний нөхцөл, нууцлалын баталгаа болон Монгол улсын хууль дүрмийн дагуу шийдвэрлэнэ.</li>
                            <li>
                                Хэрэглэгч санал хүсэлт, асуулт, лавлагааг e-мэйл болон чат ашиглан мөн 1800-1515 утсаар оператортой холбогдон хийж болно.</li>
                        </ol>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Буцах</button>
                    <button type="button" onclick="serviceconditionCheck(); return false;" class="btn btn-primary">Зөвшөөрч байна</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        /*checkRegister = function(){
            var phone = $("#register");
            if(!phone.val().match(/[А-Яа-яӨөҮү]{2}[0-9]{8}/)) {
                $(".msg").html('<font color="red">РД алдаатай байна эсвэл крилл үсгээр бичнэ үү...</font>');
                $(phone).focus();
            }else{
                $(".msg").html('<font color="green">Тохирч байна</font>');
            }
        }*/
        serviceconditionCheck = function(){
            $("#servicecondition").attr('checked',true);
            $(".service_condition .btn-secondary").click();
        }
    </script>
@endsection
