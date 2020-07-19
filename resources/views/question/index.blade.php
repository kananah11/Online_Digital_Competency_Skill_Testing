@extends('master')
@section('title','Welcome to KMUTNB')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br><br>
            <div align="right"><a href="{{ route('question.create') }}"
                    class="btn btn-success">เพิ่มข้อสอบ</a> </div><br>


            @if(\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif

        </div>

        <div class="col-md-12">
            <h1>ข้อสอบ</h1>


            <table class="table table-bordered table-striped">
                <tr>

                    <th>หมวดหมู่</th>
                    <th>ระดับ</th>
                    <th>สถานะ</th>
                    <th align="center">อัพเดท</th>
                    <th>viwe</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                @foreach($examinations as $row) <tr>



                        <td>{{ $row->Category->topic }}</td>
                        @if($row['degree']==1)
                            <td>ง่าย</td>
                        @elseif($row['degree']==2)
                            <td>ปานกลาง</td>
                        @elseif($row['degree']==3)
                            <td>ยาก</td>
                        @endif

                        @if($row['status']==0)
                            <td>รอการอนุมัติ</td>
                        @else
                            <td>ไม่อนุมัติ</td>
                        @endif
                        <td>{{ $row['updated_at'] }}</td>
                        <td><a href="{{ action('QuestionController@show', $row['id']) }}"
                                class="btn btn-success">View</a></td>
                        <td><a href="{{ action('QuestionController@edit', $row['id']) }}"
                                class="btn btn-warning">Edit</a></td>

                        <td>
                            <form method="post" class="delete_form"
                                action="{{ action('QuestionController@destroy',$row['id']) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button typze="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </td>
                        </tr>
                    @else


                    @endif

                @endforeach
            </table>


        </div>
    </div>
</div>

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



@stop
