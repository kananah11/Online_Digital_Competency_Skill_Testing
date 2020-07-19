@extends('master')
@section('title', 'เข้าสู่ระบบจัดทำชุดข้อสอบ')
@section('content')
<head>
    <script type="text/javascript" >
        var i = 1;
        <?php $rp = 1; ?>

        $(function() {
  $("#addMore").click(function(e) {
    e.preventDefault();
    i=i+1;
    <?php $rp = $rp + 1; ?>
    $("#createTextbox").append("<div class=" +
                    '"col-md-12" id="box' + i + '"' +
                    "style=" +
                    '"background-color:#FFEFD5; border: 2px solid orange;padding:"' + " >  <input type=\"button\"   class=\"close\" name=\"delete\" id=\"delete\"  value=\"x\" onClick=\"hide()\">  <br>" +
                    '<select  id="cate'+i+'" name=' +
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

        function hide() {

            var el = document.getElementById("box" + i);

            // el.style.display = 'none';
            el.remove();

            i = i - 1
            <?php $rp = $rp - 1; ?>
            document.getElementById("get").value = i;
        }

    </script>
</head>

<div class="container">

        <br>


        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(\Session::has('error'))
        <div class="alert alert-danger">
            <p>{{ \Session::get('error') }}</p>
        </div>
        @endif

        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif

        <div class="card">
  <h3 class="card-header" align="center">
  จัดทำชุดข้อสอบ
  </h3>
  <div class="card-body">

  <form name="form" method="post" action="{{url('structure')}}">
            <div align="center" >
                <label class="control-label" for="inputSuccess">ชื่อโครงสร้างชุดข้อสอบ</label>
                <input type="text" id="asd" name='struc_name' value=""  required>
                <input type="text" id="asd" name='id_chud' value="{{$id_chud}}" hidden>
            </div>
            {{csrf_field()}}
            <div align="right" >

                <button class="btn btn-primary" id="addMore">เพิ่มข้อมูล</button>
                <!-- <input type="button" class="btn btn-primary" value="เพิ่มข้อมูล"id="addMore" > -->
                <!-- <div id="createTextbox"></div> -->

            </div>
            <br>
            <div id="createTextbox">
            <div class="col-md-12"  style="background-color:#FFEFD5; border: 2px solid orange;" >
                <br>
                <select   name="categories1" required id="cate1" >
                    <option  value="0">----------กรุณาเลือกหมวดหมู่----------</option>
                    @foreach($list as $row)

                    @if($row['status']==1)
                    <option  value="{{$row['id']}}">{{$row['topic']}}</option>
                    @endif

                    @endforeach

                </select>

                <br>
                <label for="name" >กรุณาเลือกระดับ</label><br><br>

                ง่าย : <input type="text" id="easy1" name="easy1" value="0" required>
                ปานกลาง : <input type="text" id="medium1" name="medium1" value="0" required>
                ยาก : <input type="text" id="้hard1" name="hard1" value="0" required>   <br><br><br>


            </div>


            </div>

            <br>

            <div align="center" class="form-group has-warning" > <br> <br> <br> <br> <br> <br>
                กำหนดระยะเวลาในการสอบ <input type="text" class="text-center" name="inputtime" id="inputtime" required> นาที
            </div>

            <input type="text" id="get" name='get' value="1" hidden/>

            <br>
            <div align="center">
                <input type="submit" class="btn btn-success" value="บันทึก" >
                <a href = "{{url('structure')}}" class="btn btn-info"  >กลับ</a>
            </div>



        </form>
  </div>
</div>





<script>


// $('#cate1').change(function() {

//
// // alert(i);
// location.reload();
// // $(this).val()
//     // if ($(this).val() === '1') {

//     // }
// });







</script>


</div>


@stop
