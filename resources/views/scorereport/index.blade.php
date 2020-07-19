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

        <h2>ชุดข้อสอบ</h2>
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif

        @if(\Session::has('errors'))

<?php

$mas = Session::get('errors');
echo "<script type='text/javascript'> window.alert('$mas');</script>"; ?>


@endif
        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>รหัสชุดข้อสอบ</th>
                    <th>ชื่อการสอบ</th>
                    <th>รายละเอียด</th>
                    <th>ดูรายงานคะแนน</th>




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
      ajax: '{{ url('data/score') }}',
      columns: [
          {data: 'id', name: 'id'},
          {data: 'str_id', name: 'str_id'},
          {data: 'description', name: 'description'},
          {data: 'action', name: 'action', orderable: false, searchable: false},

      ]
  });
});
</script>


<script type="text/javascript">
    $(document).ready(function () {
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
