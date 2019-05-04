<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- Эрүүл мэндийн төв -->
<div class="container">
  <div class="input-layout1 gradient-padding post-ad-page">
    <form id="post-add-form" method="post" action="{{asset("postAdd")}}">
      {{ csrf_field() }}
      <br/>

      {{-- default data --}}
      <div id="hospital" class="mainbox col-md-12 col-sm-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Эрүүл мэндийн төв</div>
          </div>
          <div class="panel-body form-group">

            {{-- hospital_date --}}
            <div id="hospital_date" class="form-group required">
              <label for="hospital_date" class="control-label col-md-6 requiredField">Хамаарах огноо<span class="asteriskField">*</span> </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="hospital_date" name="hospital_date" style="margin-bottom: 10px" type="date" />
              </div>
            </div>

            {{-- site_id --}}
            <div id="site_id" class="form-group required">
              <label for="site_id" class="control-label col-md-6 requiredField">Сум<span class="asteriskField">*</span></label>
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

            {{-- birth --}}
            <div id="birth" class="form-group required">
              <label for="birth" class="control-label col-md-6 requiredField">төрсөн хүний тоо<span class="asteriskField">*</span> </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="birth" maxlength="30" name="birth" style="margin-bottom: 10px" type="number" />
              </div>
            </div>

            {{-- die --}}
            <div id="die" class="form-group required">
              <label for="die" class="control-label col-md-6 requiredField">нас барсан хүний тоо<span class="asteriskField">*</span>
              </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="die" maxlength="30" name="die" style="margin-bottom: 10px" type="number" />
              </div>
            </div>

            {{-- call_remote --}}
            <div id="call_remote" class="form-group required">
              <label for="call_remote" class="control-label col-md-6 requiredField">
                алсын дуудлага<span class="asteriskField">*</span>
              </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="call_remote" maxlength="30" name="call_remote" style="margin-bottom: 10px" type="number" />
              </div>
            </div>

            {{-- call_near --}}
            <div id="call_near" class="form-group required">
              <label for="call_near" class="control-label col-md-6 requiredField">ойрын дуудлага<span
                  class="asteriskField">*</span> </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="call_near" maxlength="30" name="call_near" style="margin-bottom: 10px" type="number" />
              </div>
            </div>

            {{-- inspection --}}
            <div id="inspection" class="form-group required">
              <label for="inspection" class="control-label col-md-6 requiredField"> урьдчилан сэргийлэх үзлэг<span class="asteriskField">*</span>
              </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="inspection" maxlength="30" name="inspection" style="margin-bottom: 10px" type="number" />
              </div>
            </div>

            {{-- inpatient --}}
            <div id="inpatient" class="form-group required">
              <label for="inpatient" class="control-label col-md-6 requiredField">хэвтэн эмчлүүлэгч<span class="asteriskField">*</span>
              </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="inpatient" maxlength="30" name="inpatient" style="margin-bottom: 10px" type="number" />
              </div>
            </div>

            {{-- ytt --}}
            <div id="ytt" class="form-group required">
              <label for="ytt" class="control-label col-md-6 requiredField">ЯТТ<span class="asteriskField">*</span>
              </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="ytt" maxlength="30" name="ytt" style="margin-bottom: 10px" type="number" />
              </div>
            </div>

            <div class="form-group mt-20 center">
              <button type="submit" class="cp-default-btn-sm btn-default">Нэмэх</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
