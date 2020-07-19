@extends('master')
@section('title', 'Edit')
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
                 $(function() {
  $("#addMore").click(function(e) {
    e.preventDefault();
    i=i+1;
    $("#createTextbox").append("<div class=" +
                    '"col-md-12" id="box' + i + '"' +
                    "style=" +
                    '"background-color:#FFEFD5; border: 2px solid orange;padding:"' + " >  <input type=\"button\"   class=\"close\" name=\"delete\" id=\"delete\"  value=\"x\" onClick=\"hide()\">  <br>" +
                    "<select  name=" +
                    '"categories' + i + '"required "' +
                    '><option value="">----------กรุณาเลือกหมวดหมู่----------</option>@foreach($list as $row)' +
                    '@if($row["status"]==1)' +
                    '<option value="{{$row["id"]}}">' +
                    '{{$row["topic"]}}</option> @endif <br>@endforeach</select><br><label for="name">กรุณาเลือกระดับ</label><br>' +
                    '<br>ง่าย : <input type=' + '"text"' + 'name=' + '"easy' + i + '"value="0" "' + '"required "' + '"' +
                    '> ปานกลาง : <input type=' + '"text"' + 'name=' + '"medium' + i + '"value="0" "' + '"required "' + '"' +
                    '> ยาก : <input type=' + '"text"' + 'name=' + '"hard' + i + '"value="0" "' + '"required "' + '"' +
                    '>   <br><br><br></div> ');
                    document.getElementById("get").value = i;
  });
});

            function hide() {    //ลบช่อง

            var el = document.getElementById("box"+i);

                // el.style.display = 'none';
                el.remove();

                 i=i-1
            document.getElementById("get").value = i;
            }


        </script>


<div class="container">
<br />
<div class="card">
  <h4 class="card-header"  align="center">
  แก้ไขชุดข้อสอบ
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
            <input type="text" id="asd" name='struc_name' value="{{$chud->struc_name}}" >
            <input type="text" id="asd" name='id_chud'placeholder="รหัสชุดข้อสอบ" value="{{$id}}" hidden/>
        </div>



        <div align="right" >

                    <button class="btn btn-primary" id="addMore">เพิ่มข้อมูล</button>
                    <!-- <div id="createTextbox"></div> -->
                </div>
                <div id="createTextbox">
        @foreach($chuds as $data)

               <div class="col-md-12"  style="background-color:#FFEFD5; border: 2px solid orange;" id="box{{$x}}" >
                    <br>
                    <input type="button"   class="close" name="delete" id="delete"  value="x" onClick="hide()">
                    <select  name="categories{{$x}}" required>
                        @foreach($list as $rows)

                         @if($rows['id']==$data->cate_id)
                        <option value="{{$data->cate_id}}">{{$rows['topic']}}</option>
                        @endif
                        @endforeach


                        @foreach($list as $row)

                        @if($row['status']==1)
                        <option value="{{$row['id']}}">{{$row['topic']}}</option>
                        @endif

                        @endforeach

                    </select>

                    <br>
                    <label for="name" >กรุณาเลือกระดับ</label><br><br>

                    ง่าย : <input type="text" id="easy1" name="easy{{$x}}" value="{{$data->easy}}" required>
                    ปานกลาง : <input type="text" id="medium1" name="medium{{$x}}" value="{{$data->medium}}" required>
                    ยาก : <input type="text" id="้hard1" name="hard{{$x}}" value="{{$data->hard}}" required>   <br><br><br>
                </div>
                    <?php $x = $x + 1; ?>
                @endforeach
                </div>
                <input type="text" id="get" name='get' value="{{$result}}" hidden >
                <div align="center" class="form-group has-warning" > <br> <br>
                กำหนดระยะเวลาในการสอบ <input type="text" class="text-center" name="inputtime" id="inputtime"  value="{{$chud->time}}" required> นาที
                </div>
        <br><br>
        <div class="form-group col-12 "  align="center">
            <input type="submit" class="btn btn-primary" value="บันทึก" />
            <a href = "{{url('structure')}}" class="btn btn-info"  >กลับ</a>
        </div>

        <input type="hidden" name="_method" value="PATCH" />
    </form>
  </div>
</div>





</div>



@endsection