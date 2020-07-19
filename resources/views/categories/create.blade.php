@extends('master')
@section('title','จัดการฐานข้อมูล')
@section('content')
<div class="container">
<br>
<div class="card">
  <div class="card-header">
  <h3 align="center">เพิ่มหมวดหมู่</h3>
  </div>
  <div class="card-body">
  @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul> @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
            @endif




            <form method="post" action="{{url('categories')}}"  class="col-md-12">
                {{csrf_field()}}
                <div class="float-center">
                <div class="form-group col-md-12"  >
                <label for="txt_UserName" class="col-6 m-0 p-0 control-label">ชื่อหมวดหมู่<span class="text-danger">*</span></label>

				<div class="col-12 m-0 p-0">
				    <input  type="text" name="topic"   id="txt_UserName" class="form-control" placeholder="ป้อนชื่อหมวดหมู่" required >
				</div>


			</div>


                <div class="form-group col-md-12">
                <label for="active" class="col-6 m-0 p-0 control-label">สถานะ</label><br>

                    <input type="radio" id="active" name="status" value="1" checked="ture" >Active &nbsp; &nbsp;
                    <input type="radio" id="active" name="status" value="0">Inactive<br>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="บันทึก" />
                </div>
                </div>
            </form>



  </div>
</div>




</div>

@stop
