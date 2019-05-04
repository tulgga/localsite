<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- Цагдаагийн газар -->
<div class="container">
  <div class="input-layout1 gradient-padding post-ad-page">
    <form id="post-add-form" method="post" action="{{asset("postAdd")}}" >
      {{ csrf_field() }}
      <br/>

        {{-- default data --}}
        <div id="police" class="mainbox col-md-12 col-sm-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title">Цагдаагийн мэдээ</div>
            </div>
            <div class="panel-body form-group">

              {{-- police_date --}}
              <div id="police_date" class="form-group required">
                <label for="police_date" class="control-label col-md-6 requiredField">Хамаарах огноо<span
                    class="asteriskField">*</span> </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="police_date"
                         name="police_date" style="margin-bottom: 10px" type="date" />
                </div>
              </div>

              {{-- site_id --}}
              <div id="site_id" class="form-group required">
                <label for="site_id" class="control-label col-md-6 requiredField">
                  Сум<span class="asteriskField">*</span>
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
            </div>
          </div>
        </div>

        {{-- crime --}}
        <div id="crime" class="mainbox col-md-12 col-sm-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title">Гэмт хэрэг</div>
            </div>
            <div class="panel-body form-group">

              {{-- crime_kill --}}
              <div id="crime_kill" class="form-group required">
                <label for="crime_kill" class="control-label col-md-6 requiredField">Хүн амь<span
                    class="asteriskField">*</span> </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="crime_kill" maxlength="30"
                         name="crime_kill" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- crime_theft --}}
              <div id="crime_theft" class="form-group required">
                <label for="crime_theft" class="control-label col-md-6 requiredField">
                  Хулгай<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="crime_theft" maxlength="30"
                         name="crime_theft" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- crime_movement --}}
              <div id="crime_movement" class="form-group required">
                <label for="crime_movement" class="control-label col-md-6 requiredField">
                  хөдөлгөөний аюулгүй байдлын хэрэг<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="crime_movement" maxlength="30"
                         name="crime_movement" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- crime_other --}}
              <div id="crime_other" class="form-group required">
                <label for="crime_other" class="control-label col-md-6 requiredField">
                  Бусад<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="crime_other" maxlength="30"
                         name="crime_other" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

            </div>
          </div>
        </div>

        {{-- administrative conflicts --}}
        <div id="ac" class="mainbox col-md-12 col-sm-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title">Захиргааны зөрчил</div>
            </div>
            <div class="panel-body form-group">

              {{-- ac_family --}}
              <div id="ac_family" class="form-group required">
                <label for="ac_family" class="control-label col-md-6 requiredField">гэр бүлийн хүчирхийлэл<span
                    class="asteriskField">*</span> </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="ac_family" maxlength="30"
                         name="ac_family" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- ac_healing --}}
              <div id="ac_healing" class="form-group required">
                <label for="ac_healing" class="control-label col-md-6 requiredField">
                  эрүүлжүүлэх<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="ac_healing" maxlength="30"
                         name="ac_healing" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- ac_arrest --}}
              <div id="ac_arrest" class="form-group required">
                <label for="ac_arrest" class="control-label col-md-6 requiredField">
                  баривчлагдсан<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="ac_arrest" maxlength="30"
                         name="ac_arrest" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- ac_fine --}}
              <div id="ac_fine" class="form-group required">
                <label for="ac_fine" class="control-label col-md-6 requiredField">
                  торгууль<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="ac_fine" maxlength="30"
                         name="ac_fine" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- ac_other --}}
              <div id="ac_other" class="form-group required">
                <label for="ac_other" class="control-label col-md-6 requiredField">
                  Бусад<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="ac_other" maxlength="30"
                         name="ac_other" style="margin-bottom: 10px" type="number" />
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="form-group mt-20">
        <button type="submit" class="cp-default-btn-sm">Нэмэх</button>
      </div>
    </form>
  </div>
</div>
