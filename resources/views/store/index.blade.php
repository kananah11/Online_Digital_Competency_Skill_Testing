@extends('master')
@section('title','Welcome to KMUTNB')
@section('content')
<style>

/* .text-center {
    text-align: center!important;
} */

.m_width_200p {
    min-width: 200px;
}

.m_width_160p {
    min-width: 160px;
}

.m_width_120p {
    min-width: 120px;
}

#sc th {
     text-align: center;
}

</style>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container">
        <br>



        <h2>คลังข้อสอบ</h2>
        @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <select   name="categories" required id="cate1" >
                    <option  value="0">----------กรุณาเลือกหมวดหมู่----------</option>
                    @foreach($list as $row)

                    @if($row['status']==1)
                    <option  value="{{$row['id']}}">{{$row['topic']}}</option>
                    @endif

                    @endforeach

                </select>


        <table class="table table-bordered table-striped" id="table">
            <thead>
                <tr>
                    <th>หมวดหมู่</th>
                    <th>ระดับ</th>
                    <th>ถูกนำไปสอบ</th>
                    <th>ทำถูก</th>
                    <th>ทำผิด</th>
                    <th>อัพเดท</th>
                    <th>action</th>
                    <th>delete</th>
                </tr>

            </thead>
        </table>


<br>


        <div class="col-12 col-md-12 pt-4 pb-2 ">
            <div class="d-flex justify-content-between">
                <div class="txt_exam_head"><h4 >จำนวนข้อสอบ</h4></div>
            </div>
        </div>



            <table class="table table_mfl text-center mb-0 table-hover-mfl" id="sc">
            <thead class="">
                <tr class="bg_grey_DD">
                <th class="m_width_300p txt_m_spac-1p rounded-top-left" >หมวดหมู่</th>
                <th class="m_width_200p txt_m_spac-1p"align="center">ข้อง่าย</th>
                <th class="m_width_160p txt_m_spac-1p"align="center">ข้อปานกลาง</th>
                <th class="m_width_120p txt_m_spac-1p rounded-top-right"align="center">ข้อยาก</th>
                </tr>
            </thead>
            <tbody>
            <?php $j = 0; ?>



@foreach($cate as $data)
<tr>

<td class="text-left" >{{$data['topic']}}</td>
    @for($x=0;$x<$i;$x++)
    @if($x==$j)


                    <td class="text-center">{{$eall[$x]}}</td>
                    <td class="text-center">{{$meall[$x]}}</td>
                    <td class="text-center">{{$hall[$x]}}</td>
    @endif
    @endfor
    </tr>
    <?php $j = $j + 1; ?>
@endforeach


                        </tbody>
            </table>






    <br>
</body>

<footer></footer>
<script>

$('#cate1').change(function() {



});

    $(function () {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url('data/store') }}',
            columns: [{
                    data: 'name_cate',
                    name: 'name_cate'
                },
                {
                    data: 'degree',
                    name: 'degree'
                },


                {
                    data: 'count',
                    name: 'count'
                },
                {
                    data: 'correct',
                    name: 'correct'
                },
                {
                    data: 'incorrect',
                    name: 'incorrect'
                },
                 {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'delete',
                    name: 'delete',
                    orderable: false,
                    searchable: false
                },

            ]
        });
    });

</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('.delete_form').on('submit', function () {
            if (confirm("คุณต้องการลบข้อมูลหรือไม่ ?")) {
                return true;
            } else {
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
