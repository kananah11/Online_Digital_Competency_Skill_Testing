
@extends('master')
@section('title', 'จัดการฐานข้อมูล')
@section('content')
<div class="container">
<br />
<div class="card">
  <h5 class="card-header" align="center">
  เพิ่มข้อมูลผู้ใชงานระบบ
  </h5>
  <div class="card-body">
  @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul> @foreach($errors->all() as $error)
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


            <form method="post" action="{{url('user')}}"> {{csrf_field()}}


                <div class="form-group">
                <label for="txt_UserName" class="col-6 m-0 p-0 control-label">บัญชีผู้ใช้งาน<span class="text-danger">*</span></label>
                    <input type="text" id="txt_UserName" name="id" class="form-control" placeholder="ป้อนบัญชืผู้ใช้งาน"  required/>
                </div>


                <div class="form-group">
                    <input type="checkbox" id="admin1" name="admin1" value="2"  >
                    <label for="vehicle1">มีสิทธิเป็นผู้ดูแลระบบ</label><br>
                    <input type="text" id="admin"  name='admin' hidden="true">

                    <input type="checkbox" id="create_question1" name="create_question1"  value="2"  >
                    <label for="vehicle2">มีสิทธิเป็นผู้ออกข้อสอบ</label><br>
                    <input type="text" id="create_question"  name='create_question' hidden="true">

                    <input type="checkbox" id="screener1" name="screener1" value="2" >
                    <label for="vehicle3">มีสิทธิเป็นผู้คัดกรองข้อสอบ</label><br>
                    <input type="text"  id="screener"  name='screener' hidden="true">

                    <input type="checkbox" id="str1" name="str1" value="2" >
                    <label for="vehicle4">มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ</label><br>
                    <input type="text" id="str"  name='str' hidden="true">

                    <input type="checkbox" id="vehiprepare1" name="prepare1" value="2" >
                    <label for="vehicle4">มีสิทธิเป็นผู้จัดทำชุดข้อสอบ</label>
                    <input type="text" id="vehiprepare"  name='prepare' hidden="true">

                    <br><br>
                </div>


                <div class="form-group" align="center">
                    <input type="submit" class="btn btn-primary" value="เพิ่ม" onclick="sum()" />
                    <a type="button" href="{{ url('user') }}" class="btn btn-danger" >กลับ</a>
                </div>
            </form>
  </div>

</div>






            <script type="text/javascript">
                $(document).ready(function () {


                    if (document.getElementById("admin1").checked == true) {
                        document.getElementById("admin").value = 1;
                    } else if (document.getElementById("admin1").checked == false) {
                        document.getElementById("admin").value = 0;
                    }

                    if (document.getElementById("create_question1").checked == true) {
                        document.getElementById("create_question").value = 1;
                    } else if (document.getElementById("create_question1").checked == false) {
                        document.getElementById("create_question").value = 0;
                    }

                    if (document.getElementById("screener1").checked == true) {
                        document.getElementById("screener").value = 1;
                    } else if (document.getElementById("screener1").checked == false) {
                        document.getElementById("screener").value = 0;
                    }

                    if (document.getElementById("vehiprepare1").checked == true) {
                        document.getElementById("vehiprepare").value = 1;
                    } else if (document.getElementById("vehiprepare1").checked == false) {
                        document.getElementById("vehiprepare").value = 0;
                    }


                    if (document.getElementById("str1").checked == true) {
                        document.getElementById("str").value = 1;
                    } else if (document.getElementById("str1").checked == false) {
                        document.getElementById("str").value = 0;
                    }



                });



                function sum() {
                    check1();
                    check2();
                    check3();
                    check4();
                    check5();
                }

                function check1() {
                    var a = 0;

                    if (document.getElementById("admin1").checked == true) {
                        document.getElementById("admin").value = 1;
                    } else if (document.getElementById("admin1").checked == false) {
                        document.getElementById("admin").value = 0;
                    }
                }

                function check2() {
                    if (document.getElementById("create_question1").checked == true) {
                        document.getElementById("create_question").value = 1;
                    } else if (document.getElementById("create_question1").checked == false) {
                        document.getElementById("create_question").value = 0;
                    }
                }

                function check3() {
                    if (document.getElementById("screener1").checked == true) {
                        document.getElementById("screener").value = 1;
                    } else if (document.getElementById("screener1").checked == false) {
                        document.getElementById("screener").value = 0;
                    }
                }

                function check4() {

                    if (document.getElementById("vehiprepare1").checked == true) {
                        document.getElementById("vehiprepare").value = 1;
                    } else if (document.getElementById("vehiprepare1").checked == false) {
                        document.getElementById("vehiprepare").value = 0;
                    }
                }
                function check5() {

if (document.getElementById("str1").checked == true) {
    document.getElementById("str").value = 1;
} else if (document.getElementById("str1").checked == false) {
    document.getElementById("str").value = 0;
}
}

            </script>

        </div>



        @endsection
