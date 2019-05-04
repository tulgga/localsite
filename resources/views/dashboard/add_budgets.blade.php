<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- Төсөв -->
<div class="container">
  <div class="input-layout1 gradient-padding post-ad-page">
    <form id="post-add-form" method="post" action="{{asset("postAdd")}}">
      {{ csrf_field() }}
      <br/>

      {{-- default data --}}
      <div id="police" class="mainbox col-md-12 col-sm-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Төсөв</div>
          </div>
          <div class="panel-body form-group">

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

            {{-- b_type --}}
            <div id="b_type" class="form-group required">
              <label for="b_type" class="control-label col-md-6 requiredField">Төсвийн төрөл<span class="asteriskField">*</span>
              </label>
              <div class="controls col-md-6">
                <div class="form-group">
                  <div class="custom-select" >
                    {{--
                      сум, аймаг
                        1-3:  санхүү
                        4:    тусдаа 1 акаунт байна
                    --}}
                    <select id="b_type" class="select2 input-md  textinput textInput form-control" name="b_type" required>
                      <option value="">Төсвийн төрөл сонгох</option>
                      <option value="1">Улсын төсөв</option>
                      <option value="2">ОНХ сангийн төсөв</option>
                      <option value="3">Замын төсөв</option>
                      <option value="4">ЗД ын нөөц хөрөнгө</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            {{-- b_approved --}}
            <div id="b_approved" class="form-group required">
              <label for="b_approved" class="control-label col-md-6 requiredField">Батлагдсан төсөв<span class="asteriskField">*</span> </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="b_approved" name="b_approved" style="margin-bottom: 10px" type="decimal" />
              </div>
            </div>

            {{-- b_done --}}
            <div id="b_done" class="form-group required">
              <label for="b_done" class="control-label col-md-6 requiredField">зарцуулагдсан төсөв<span class="asteriskField">*</span> </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="b_done" name="b_done" style="margin-bottom: 10px" type="decimal" />
              </div>
            </div>

            {{-- b_doing --}}
            <div id="b_doing" class="form-group required">
              <label for="b_doing" class="control-label col-md-6 requiredField">хэрэгжиж байгаа<span class="asteriskField">*</span> </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="b_doing" name="b_doing" style="margin-bottom: 10px" type="decimal" />
              </div>
            </div>

            {{-- b_do --}}
            <div id="b_do" class="form-group required">
              <label for="b_do" class="control-label col-md-6 requiredField">үлдэгдэл<span class="asteriskField">*</span> </label>
              <div class="controls col-md-6">
                <input class="input-md  textinput textInput form-control" id="b_do" name="b_do" style="margin-bottom: 10px" type="decimal" />
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
