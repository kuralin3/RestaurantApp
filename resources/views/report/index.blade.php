@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <hr>
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>
                  {{$error}}
                </li>
              @endforeach
            </ul>
          </div>
          @endif
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Report</li>
            </ol>
          </nav>
      </div>
    </div>
    <div class="row">
      <form action="/report/show" method="GET">
        <div class="col-md-12">
          <label>Choose Date For Report</label>
          <div class="form-group">
            <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                 <input type="text" name="dateStart" sclass="form-control datetimepicker-input" data-target="#datetimepicker7"/>
                 <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                     <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                 </div>
             </div>
         </div>
         <div class="form-group">
          <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
               <input type="text" name="dateEnd" class="form-control datetimepicker-input" data-target="#datetimepicker8"/>
               <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                   <div class="input-group-text"><i class="fa fa-calendar"></i></div>
               </div>
           </div>
         </div>
         <input type="submit" class="btn btn-primary" value="Show Report">
        </div>
      </form>
    </div>
  </div>

  <script type="text/javascript">
    $(function () {
        $('#datetimepicker7').datetimepicker();
        $('#datetimepicker8').datetimepicker({
            useCurrent: false
        });
        $("#datetimepicker7").on("change.datetimepicker", function (e) {
            $('#datetimepicker8').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker8").on("change.datetimepicker", function (e) {
            $('#datetimepicker7').datetimepicker('maxDate', e.date);
        });
    });
  </script>
@endsection