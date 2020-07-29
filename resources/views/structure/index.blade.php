@extends('master')
@section('title','Welcome to KMUTNB')
@section('content')


<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container">
        <br>
        <div align="right">
            <a href = "{{route('structure.create')}}" class="btn btn-success"  >เพิ่มโครงสร้างชุดข้อสอบ</a>
        </div>
        <h2>โครงสร้างชุดข้อสอบ</h2>
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>ชื่อ</th>
                    <th>จำนวนข้อ</th>
                    <th>เวลาที่ใช้สอบ</th>
                    <th>สถานะ</th>
                    <th>อัพเดท</th>
                    <th>action</th>
                    <th>delete</th>


                </tr>

            </thead>
        </table>
    </div>
</body>


<script>
$(function () {
  $('#table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{{ url('data/struc') }}',
      columns: [
          {data: 'struc_name', name: 'struc_name'},
          {data: 'count', name: 'count'},
          {data: 'time', name: 'time'},
          {data: 'status', name: 'status'},
          {data: 'updated_at', name: 'updated_at'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
          {data: 'delete', name: 'delete', orderable: false, searchable: false},
      ]
  });

  $('.delete_form').on('submit', function () {
            if (confirm("คุณต้องการลบข้อมูลหรือไม่ ?")) {
                return true;
            }
            else {
                return false;
            }
        });

});






    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);

</script>



</html>
@stop
