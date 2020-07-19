@extends('master')
@section('title','Welcome to KMUTNB')
@section('content')


<head>

<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  </head>

  <body>
  <div class="container">
<br>

            <h2>การอนุมัติข้อสอบ </h2>
            @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
            @endif
            <table class="table table-bordered table-striped" id="table">
               <thead>
                  <tr>
                     <th>หมวดหมู่</th>
                     <th>ระดับ</th>
                     <th>สถานะ</th>
                     <th>อัพเดท</th>
                     <th>action</th>



                  </tr>

               </thead>
            </table>
</div>
  </body>

  <footer></footer>
  <script>
         $(function() {
               $('#table').DataTable({
                processing: true,
        serverSide: true,
               ajax: '{{ url('index') }}',
               columns: [
                        { data: 'name_cate', name: 'name_cate' },
                        { data: 'degree', name: 'degree' },
                        { data: 'status', name: 'status' },
                        { data: 'updated_at', name: 'updated_at' },
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
