<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- Онцгой байдлын газар -->
<div class="container">
  <div class="input-layout1 gradient-padding post-ad-page">
    <form id="post-add-form" method="post" action="{{asset("postAdd")}}">
      {{ csrf_field() }}
      <br/>

        {{-- default data --}}
        <div id="nema" class="mainbox col-md-12 col-sm-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-title">Онцгой байдлын газар</div>
            </div>
            <div class="panel-body form-group">

              {{-- nema_date --}}
              <div id="nema_date" class="form-group required">
                <label for="nema_date" class="control-label col-md-6 requiredField">Хамаарах огноо<span
                    class="asteriskField">*</span> </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="nema_date" name="nema_date" style="margin-bottom: 10px" type="date" />
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

              {{-- fo --}}
              <div id="fo" class="form-group required">
                <label for="fo" class="control-label col-md-6 requiredField">ойн хээрийн түймэр<span class="asteriskField">*</span> </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="fo" maxlength="30" name="fo" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- ff --}}
              <div id="ff" class="form-group required">
                <label for="ff" class="control-label col-md-6 requiredField"> объектын гал түймэр<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="ff" maxlength="30" name="ff" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- sos --}}
              <div id="sos" class="form-group required">
                <label for="sos" class="control-label col-md-6 requiredField">аюул үзэгдэл ослын дуудлага<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="sos" maxlength="30" name="sos" style="margin-bottom: 10px" type="number" />
                </div>
              </div>

              {{-- sos_description --}}
              <div id="sos_description" class="form-group required">
                <label for="sos_description" class="control-label col-md-6 requiredField">аюул үзэгдэл ослын дуудлагын тайлбар<span class="asteriskField">*</span>
                </label>
                <div class="controls col-md-6">
                  <input class="input-md  textinput textInput form-control" id="sos_description" maxlength="30" name="sos_description" style="margin-bottom: 10px" type="number" />
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
