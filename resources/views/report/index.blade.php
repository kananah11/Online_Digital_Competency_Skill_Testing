@extends('master')
@section('title','Welcome to KMUTNB')
@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@stop

@section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class="container">
    <br><br>
    <div align="right"><a href="{{ route('report.create') }}"
            class="btn btn-success">เพิ่มผู้ออกใบรับรอง</a> </div>

    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif

    <h1>การจัดการผู้ออกใบรับรอง</h1>







            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Topic</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                @foreach($signa as $row) <tr>


                        <td>{{ $row['id'] }}</td>
                        <td>{{ $row['name'] }}</td>
                        <td>{{ $row['position'] }}</td>
                        <td><input id="activeSwitch{{$row['id']}}" type="checkbox" class="tg" data-toggle="toggle" data-onstyle="success" value="{{$row['id']}}" >
                        <input type="hidden" id="activeStatus{{$row['id']}}" value="{{$row['status']}}"/>
                        </td>


                        <td>
                            <form method="post" class="delete_form"
                                action="{{ action('CategoriesController@destroy',$row['id']) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </td>
                        </tr>




                @endforeach
            </table>



</div>


<script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $(document).ready(function () {
        $('.delete_form').on('submit', function () {
            if (confirm("คุณต้องการลบข้อมูลหรือไม่ ?")) {
                return true;
            } else {
                return false;
            }
        });
<?php

foreach ($signa as $row) {
    echo "if ($('#activeStatus" . $row['id'] . "').val().trim() == 1) {";
    echo "$('#activeSwitch" . $row['id'] . "').bootstrapToggle('on');";
    echo "} else if ($('#activeStatus" . $row['id'] . "').val().trim() == 0) {";
    echo "$('#activeSwitch" . $row['id'] . "').bootstrapToggle('off');
              }";
}
?>
<?php

foreach ($signa as $row) {
    echo "$('#activeSwitch" . $row['id'] . "').change(function(event) {\n";

    echo " $.ajax({";
    echo 'url: " ' . route('report.status') . '",' . "\n";
    echo 'method: "POST",' . "\n";
    echo "data: {\n";
    echo " value: $('#activeSwitch" . $row['id'] . "').val(),\n";
    echo "},\n";
    echo "dataType: 'JSON',\n";
    echo "success: function (ress){}\n";
    echo "})\n";
    echo "});\n";
    echo "   \n";
}

?>



    // $('#activeSwitch1').change(function(event) {
    //     console.log($(this).prop('checked'));
    //     $.ajax({
    //         url: "{{ route('report.status') }}",
    //         method: "POST",
    //         data: {
    //             value: $('#activeSwitch1').val(),
    //         },
    //         dataType: 'JSON',
    //         success: function (ress)
    //         {


    //         }
    //     })


    // })







    });
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);


    function tog(value) {
        $.ajax({
            url: "{{ route('report.status') }}",
            method: "POST",
            data: {
                value: value,
            },
            dataType: 'JSON',
            success: function (ress)
            {


            }
        })

    }





</script>



@stop
