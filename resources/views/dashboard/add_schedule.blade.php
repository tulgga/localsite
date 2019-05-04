<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- Ажлын төлөвлөгөө  болон өнөөдөр болох үйл ажиллагаанууд-->
<div class="container">
  <div class="input-layout1 gradient-padding post-ad-page">
    <form id="post-add-form" method="post" action="{{asset("postAdd")}}">
      {{ csrf_field() }}
      <br/>

      {{-- default data --}}
      <div id="police" class="mainbox col-md-12 col-sm-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Ажлын төлөвлөгөө</div>
          </div>
          <div class="panel-body form-group">

            {{-- schedule_date --}}
            <div id="schedule_date" class="form-group required">
              <label for="schedule_date" class="control-label col-md-6 requiredField">Хамаарах огноо<span class="asteriskField">*</span> </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="schedule_date" name="schedule_date" style="margin-bottom: 10px" type="date" />
              </div>
            </div>

            {{-- site_id --}}
            <div id="site_id" class="form-group required">
              <label for="site_id" class="control-label col-md-6 requiredField">Сум<span class="asteriskField">*</span>
              </label>
              <div class="controls col-md-6">
                <div class="form-group">
                  <div class="custom-select" >
                    <select id="site_id" class="select2 input-md  textinput textInput form-control" name="site_id" required>
                      <option value="">Сум сонгох</option>
                      @foreach($sites as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>

            {{-- head_id --}}
            <div id="head_id" class="form-group required">
              <label for="head_id" class="control-label col-md-6 requiredField">албан тушаал<span class="asteriskField">*</span>
              </label>
              <div class="controls col-md-6">
                <div class="form-group">
                  <div class="custom-select" >
                    {{--
                      Баянхонгор сум, аймаг
                      1-засаг дарга         / нарын бичиг оруулна /
                      2-хурлын дарга        / нарын бичиг оруулна /
                      3-тамгийн дарга       / нарын бичиг оруулна /
                      4-ХДТ                 / ХДТ ын ажилтан /
                      5-Тэмүжин театр       / Тэмүжин театр ын ажилтан /
                      6-Баганат талбайд     / Систем админ /
                      7-ЗДТГын зааланд      / Систем админ /
                      8-Сумын ЗДТГын зааланд/ Баянхонгор сумын админ /
                      9-Бусад               / Баянхонгор сумын админ, систем админ, 1 2 3ын нарын бичиг /

                      Бусад сум
                      1-засаг дарга         / нарын бичиг оруулна /
                      2-хурлын дарга        / нарын бичиг оруулна /
                      3-тамгийн дарга       / нарын бичиг оруулна /
                      4-Соёлын төв          / сумын Соёлын төвийн ажилтан /
                      9-Бусад               / сумын админ, систем админ, 1 2 3ын нарын бичиг /
                    --}}
                    <select id="head_id" class="select2 input-md  textinput textInput form-control" name="head_id" required>
                      <option value="">албан тушаал сонгох</option>
                      <option value="1">засаг дарга</option>
                      <option value="2">хурлын дарга</option>
                      <option value="3">тамгийн дарга</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>


            {{-- start_time,end_time --}}
            <div id="start_time" class="form-group required">
              <label for="start_time" class="control-label col-md-6 requiredField">эхлэх дуусах цаг<span class="asteriskField">*</span> </label>
              <div class="controls col-md-3">
                <input class="input-md  textinput textInput form-control" id="start_time" name="start_time" style="margin-bottom: 10px" type="time" />
              </div>

              <div class="controls col-md-3">
                <input class="input-md  textinput textInput form-control" id="end_time" name="end_time" style="margin-bottom: 10px" type="time" />
              </div>
            </div>

            {{-- description --}}
            <div id="description" class="form-group required">
              <label for="description" class="control-label col-md-6 requiredField">Тайлбар<span class="asteriskField">*</span>
              </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="description" maxlength="255" name="description" style="margin-bottom: 10px" type="text" />
              </div>
            </div>
            <div class="form-group mt-20">
              <button type="submit" class="cp-default-btn-sm">Нэмэх</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
