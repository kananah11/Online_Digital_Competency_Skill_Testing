@extends('master')

@section('script')

@section('content')
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
  <h5 align="center" class="card-header">
    จัดทำชุดข้อสอบ
  </h5>
  <div class="card-body">
  <form method="post" action="{{ url('examset') }}">
        {{ csrf_field() }}
        <label class="control-label">รหัสชุดข้อสอบ</label>
        <input type="text" id="asd" class="form-control" name='id_set' value="{{ $id_set }}" size="30" required><br>

        <label class="control-label" >โครงสร้างข้อสอบ</label>
        <select class="form-control" style="height: 100%;" name="str_id" required>
            <option value="" >----------กรุณาเลือกโครงสร้างข้อสอบ----------</option>
            @foreach($list as $row)

                @if($row['status']==1)
                    <option value="{{ $row['id'] }}">
                        {{ $row['struc_name'] }}</option>

                @endif
            @endforeach
        </select><br>

        <label class="control-label" >คะแนนที่สอบผ่าน(%)</label>
        <input type="text" id="a" class="form-control" name='pass' size="30" required><br>
            <label align="right" class="control-label" >รายละเอียด</label><br>

            <textarea  class="form-control" name="description" rows="8" cols="80" required></textarea>
        </div>
        <div class="form-group" align="center">
            <input type="submit" class="btn btn-primary" value="บันทึก" />
            <a type="button" href="{{ url('examset') }}" class="btn btn-danger">ยกเลิก</a>
        </div>

    </form>
  </div>
</div>


</div>
@stop
