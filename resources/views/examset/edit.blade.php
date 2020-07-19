@extends('master')
@section('title','ออกข้อสอบ')
@section('script')

@section('content')
<div class="container">
<br>
<div class="card">
  <h5  class="card-header" align="center">
   แก้ไขชุดข้อสอบ
  </h5>
  <div class="card-body">
  <form method="post" action="{{action('ExamSetController@update',$id)}}">
    {{csrf_field()}}
    <label class="control-label">รหัสชุดข้อสอบ</label>
    <input class="form-control" type="text" id="asd" name='id_set' value="{{$examset->id}}" size="30" ><br>

    <label class="control-label">โครงสร้างข้อสอบ</label>
    <select  class="form-control" style="height: 100%;" name="str_id">
        <option value="{{$examset->str_id}}">{{$examset->Structure->struc_name}}</option>
        @foreach($list as $row)

        @if($row['status']==1)
        <option value="{{$row['id']}}">{{$row['struc_name']}}</option>

        @endif
        @endforeach
    </select><br>

    <label class="control-label">คะแนนที่สอบผ่าน(%)</label>
    <input class="form-control" type="text" id="a" name='pass' value="{{$examset->pass}}" size="30" ><br>
    <div class="form-group">
    <label class="control-label" align="right">รายละเอียด</label><br>

                <textarea class="form-control" name="description" rows="8" cols="80"  >{{$examset->description}}</textarea>
            </div>
            <div class="form-group" align="center"><input type="hidden" name="_method" value="PATCH" />
                <input type="submit" class="btn btn-primary" value="Update" />
                <a type="button" href="{{url('examset')}}" class="btn btn-danger" >ยกเลิก</a>

            </div>

</form>
  </div>
</div>

</div>
@stop
