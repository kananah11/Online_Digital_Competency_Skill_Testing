@extends('master')
@section('title', 'search')
@section('content')


<script type="text/javascript" >
             <?php
$result = 0;
foreach ($chuds as $count) {
    $result++;

}

$x = 1;
echo "var i =" . $result . ";"

; ?>;
            function CreateTextbox() {
                i = i + 1;
                createTextbox.innerHTML = createTextbox.innerHTML + "<div class=" +
                        '"col-md-12"' +
                        "style=" +
                        '"background-color:#FFEFD5; border: 2px solid orange;padding:"' +
                        ">   <br>" +
                        "<select  name=" +
                        '"categories' + i + '"required "' +
                        '><option value="">----------กรุณาเลือกหมวดหมู่----------</option>@foreach($list as $row)' +
                        '@if($row["status"]==1)' +
                        '<option value="{{$row["id"]}}">' +
                        '{{$row["topic"]}}</option> @endif <br>@endforeach</select><br><label for="name">กรุณาเลือกระดับ</label><br>' +
                        '<br>ง่าย : <input type=' + '"text"' + 'name=' + '"easy' + i +  '"value="0" "'+ '"required "'+'"' +
                        '> ปานกลาง : <input type=' + '"text"' + 'name=' + '"medium' + i +  '"value="0" "'+ '"required "'+'"' +
                        '> ยาก : <input type=' + '"text"' + 'name=' + '"hard' + i +  '"value="0" "'+ '"required "'+'"' +
                        '>   <br><br><br></div> '



                document.getElementById("get").value = i;
            }


        </script>


<div class="container">
<br />
<div class="card">
  <h4 class="card-header" align="center">
  ข้อมูลชุดข้อสอบ
  </h4>
  <div class="card-body">
  @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul> @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif



    <form method="post" action="{{action('ExamStructureController@update', $id)}}">
        {{csrf_field()}}

        <div align="center" >
            <label class="control-label" for="inputSuccess">ชื่อโครงสร้างชุดข้อสอบ</label>
            <input type="text" id="asd" name='id_chud'placeholder="รหัสชุดข้อสอบ"  disabled value="{{$chud->struc_name}}" />
        </div> <br>

        @foreach($chuds as $data)
                <div class="col-md-12"  style="background-color:#FFEFD5; border: 2px solid orange;" >
                    <br> หมวดหมู่
                        @foreach($list as $rows)
                         @if($rows['id']==$data->cate_id)
                       <input type="text"  disabled value=" {{$rows['topic']}}" required>
                        @endif
                        @endforeach


<br>

                    <label for="name" >ระดับ</label><br>

                    ง่าย : <input type="text" id="easy1" name="easy{{$x}}" disabled value="{{$data->easy}}" required>
                    ปานกลาง : <input type="text" id="medium1" name="medium{{$x}}" disabled value="{{$data->medium}}" required>
                    ยาก : <input type="text" id="้hard1" name="hard{{$x}}" disabled value="{{$data->hard}}" required>   <br><br><br>
                </div>
                    <?php $x = $x + 1; ?>
                @endforeach
                <div id="createTextbox"><br></div>
                <input type="text" id="get" name='get' value="{{$result}}" hidden >
                <div align="center" ><br>
                     <h4>เวลาในการสอบ <?php echo $times->time; ?> นาที </h4>
                </div>



        <div class="form-group" align="center">
              <a href = "{{url('structure')}}" class="btn btn-info"  >กลับ</a>
        </div>

        <input type="hidden" name="_method" value="PATCH" />
    </form>

  </div>
</div>




</div>



@stop