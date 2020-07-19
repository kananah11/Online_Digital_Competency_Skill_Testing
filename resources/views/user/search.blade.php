@extends('master')
@section('title', 'ค้นหา')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12"><br>
            <h1 align="center">ค้นหาข้อมูล</th>
                <br><br>
                <div align="right">
                    <a href="{{route('user.create')}}" class="btn btn-success">เพิ่มข้อมูล</a>
                    <a href="{{route('user.index')}}" class="btn btn-primary">หน้าแรก</a>
                </div>
                <br>
                {{csrf_field()}}
                <input type="text"  name="search" id="search" placeholder="ค้นหาข้อมูล" class="form-control">
                <br>
                <h3 align="center">จำนวนข้อมูล : <span id="total_records"></span></h3>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>

                            <th>บัญชีผู้ใช้</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>

                            <th>ผู้ดูแลระบบ</th>
                            <th>ผู้ออกข้อสอบ</th>
                            <th>ผู้คัดกรองข้อสอบ</th>
                            <th>ผู้จัดทำชุดข้อสอบ</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>


                        </tr>
                    </thead>
                    <tbody></tbody>

                </table>

        </div>
    </div>


</div>
<script type="text/javascript">
    $(document).ready(function () {
       fetch_data();

    });
    $(document).on('keyup', '#search', function () {
        var query = $(this).val();
        console.log('555555');
        fetch_data(query);
    });
    function fetch_data(query = '')
 {
    $.ajax({
     url:"{{ route('user.action') }}",
     method:'GET',
     data:{query:query},
     dataType:'json',
     success:function(data)
     {
        $('tbody').html(data.table_data);
        $('#total_records').text(data.total_data);
     }
  })
 }

</script>


@stop
