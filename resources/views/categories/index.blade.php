@extends('master')
@section('title','Welcome to KMUTNB')
@section('content')

<div class="container">
    <br><br>
    <div align="right"><a href="{{ route('categories.create') }}"
            class="btn btn-success">เพิ่มหมวดหมู่</a> </div>


    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
    @endif

    <h1>การจัดการหมวดหมู่</h1>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">หมวดหมู่ที่ใช้งาน</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">หมวดหมู่ที่ไม่ได้ใช้งาน</a>
        </li>

    </ul>

    <br>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Topic</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                @foreach($categories as $row) <tr>

                    @if($row['status']==1)
                        <td>{{ $row['id'] }}</td>
                        <td>{{ $row['topic'] }}</td>
                        @if($row['status']==1)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif

                        <td><a href="{{ action('CategoriesController@edit', $row['id']) }}"
                                class="btn btn-warning">Edit</a></td>

                        <td>
                            <form method="post" class="delete_form"
                                action="{{ action('CategoriesController@destroy',$row['id']) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </td>
                        </tr>
                    @else


                    @endif

                @endforeach
            </table>
        </div>




        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Topic</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                @foreach($categories as $row) <tr>

                    @if($row['status']==0)
                        <td>{{ $row['id'] }}</td>
                        <td>{{ $row['topic'] }}</td>
                        @if($row['status']==1)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif

                        <td><a href="{{ action('CategoriesController@edit', $row['id']) }}"
                                class="btn btn-warning">Edit</a></td>

                        <td>
                            <form method="post" class="delete_form"
                                action="{{ action('CategoriesController@destroy',$row['id']) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn btn-danger">Delete</button>

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
