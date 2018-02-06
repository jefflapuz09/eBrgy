
@if ($errors->any())
<script type="text/javascript">
    toastr.error(' <?php echo implode('', $errors->all(':message')) ?>', "There's something wrong!")
</script>             
@endif

{{--  modal  --}}
<div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Update Schedule</h4>
            </div>
            <div class="modal-body">
              <div class="container" style="width:100%;">
              <form action="{{ url('/Schedule/Store') }}" method="post">
                {{csrf_field()}}
                  <div class="form-group">
                      <select class="form-control select2" style="width:100%;" name="residentId">
                          @foreach($resident as $res)
                            <option value="{{$res->id}}">{{$res->firstName}} {{$res->middleName}} {{$res->lastName}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                        <div class='input-group date' id='datetimepicker1'>
                                <input type='text' name="date" placeholder="YYYY-MM-DD"  class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                    </div>
                  <div class="form-group">
                        <div class="input-group clockpicker">
                              <input type="text" name="start" class="form-control">
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-time"></span>
                              </span>
                          </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group clockpicker">
                            <input type="text" class="form-control" name="end">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                  </div>
                  <div class="form-group">
                      <select class="form-control select2" name="officerId" style="width:100%;">
                          @foreach($officer as $of)
                            <option value="{{$of->id}}">{{$of->Resident->firstName}} {{$of->Resident->middleName}} {{$of->Resident->lastName}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="pull-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
              </form>
            </div>
            </div>
          </div>
      
        </div>
      </div>