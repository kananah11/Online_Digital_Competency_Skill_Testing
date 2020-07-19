@extends('master')
@section('title', 'Welcome Homepage')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <div align="right">

                <a href="{{route('user.create')}}" class="btn btn-success">เพิ่มข้อมูล</a>


            </div>

            @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
            @endif
            <br>
            <h1>ข้อมูลผู้ใช้งาน</h1>


            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ทั้งหมด</a></li>
                <li class="nav-item"><a class="nav-link" id="menu-1" data-toggle="tab" href="#menu1" role="tab" aria-controls="profile" aria-selected="false">ผู้ดูแลระบบ</a></li>
                <li class="nav-item"><a class="nav-link" id="menu-2" data-toggle="tab" href="#menu2" role="tab" aria-controls="profile" aria-selected="false">ผู้ออกข้อสอบ</a></li>
                <li class="nav-item"><a class="nav-link" id="menu-3" data-toggle="tab" href="#menu3" role="tab" aria-controls="profile" aria-selected="false">ผู้คัดกรองข้อสอบ</a></li>
                <li class="nav-item"><a class="nav-link" id="menu-4" data-toggle="tab" href="#menu4" role="tab" aria-controls="profile" aria-selected="false">ผู้จัดทำโครงสร้างชุดข้อสอบ</a></li>
                <li class="nav-item"><a class="nav-link" id="menu-5" data-toggle="tab" href="#menu5" role="tab" aria-controls="profile" aria-selected="false">ผู้จัดทำชุดข้อสอบ</a></li>

            </ul>
            <div class="tab-content">
            <br>
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> <?php echo $users['id']; ?>
                    <table class="table table-bordered table-striped " id= "table">

                        <tr>

                            <th>บัญชีผู้ใช้</th>
                            <th>ชื่อ-นามสกุล</th>

                            <th>ผู้ดูแลระบบ</th>
                            <th>ผู้ออกข้อสอบ</th>
                            <th>ผู้คัดกรองข้อสอบ</th>
                            <th>ผู้จัดทำโครงสร้างชุดข้อสอบ</th>
                            <th>ผู้จัดทำชุดข้อสอบ</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                        @foreach($users as $DBuser)
                        <tr>

                            <td>{{$DBuser['id']}}</td>
                            <td>{{$DBuser['name']}}</td>

                            @if($DBuser['admin']==1)
                            <td> &check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['create_question']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif

                            @if($DBuser['screener']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['structure']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['prepare']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            <td><a href="{{action('UsersController@edit', $DBuser['id'])}}" class="btn btn-warning">Edit</a></td>

                            <td>
                                <form method="post" class="delete_form" action="{{action('UsersController@destroy', $DBuser['id'])}}"> {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>


                        </tr>
                        @endforeach
                    </table>

                </div>

                <div class="tab-pane fade" id="menu1" role="tabpanel" aria-labelledby="menu-1">
                    <table class="table table-bordered table-striped" id= "table">


                        <tr>

                            <th>บัญชีผู้ใช้</th>
                            <th>ชื่อ-นามสกุล</th>

                            <th>ผู้ดูแลระบบ</th>
                            <th>ผู้ออกข้อสอบ</th>
                            <th>ผู้คัดกรองข้อสอบ</th>
                            <th>ผู้จัดทำโครงสร้างชุดข้อสอบ</th>
                            <th>ผู้จัดทำชุดข้อสอบ</th>


                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                        @foreach($users as $DBuser)
                        <tr>
                            @if($DBuser['admin']==1)


                            <td>{{$DBuser['id']}}</td>
                            <td>{{$DBuser['name']}}</td>

                            @if($DBuser['admin']==1)
                            <td> &check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['create_question']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif

                            @if($DBuser['screener']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['structure']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['prepare']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            <td><a href="{{action('UsersController@edit', $DBuser['id'])}}" class="btn btn-warning">Edit</a></td>

                            <td>
                                <form method="post" class="delete_form" action="{{action('UsersController@destroy', $DBuser['id'])}}"> {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>

                            @endif
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="tab-pane fade" id="menu2" role="tabpanel" aria-labelledby="menu-2">
                    <table class="table table-bordered table-striped" id= "table">
                        <tr>

                            <th>บัญชีผู้ใช้</th>
                            <th>ชื่อ-นามสกุล</th>

                            <th>ผู้ดูแลระบบ</th>
                            <th>ผู้ออกข้อสอบ</th>
                            <th>ผู้คัดกรองข้อสอบ</th>
                            <th>ผู้จัดทำโครงสร้างชุดข้อสอบ</th>
                            <th>ผู้จัดทำชุดข้อสอบ</th>

                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                        @foreach($users as $DBuser)
                        <tr>

                            @if($DBuser['create_question']==1)

                            <td>{{$DBuser['id']}}</td>
                            <td>{{$DBuser['name']}}</td>

                            @if($DBuser['admin']==1)
                            <td> &check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['create_question']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif

                            @if($DBuser['screener']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['structure']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['prepare']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif



                            <td><a href="{{action('UsersController@edit', $DBuser['id'])}}" class="btn btn-warning">Edit</a></td>

                            <td>
                                <form method="post" class="delete_form" action="{{action('UsersController@destroy', $DBuser['id'])}}"> {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

                        @endif
                        @endforeach
                    </table>
                </div>

                <div class="tab-pane fade" id="menu3" role="tabpanel" aria-labelledby="menu-3">
                    <table class="table table-bordered table-striped" id= "table">
                        <tr>

                            <th>บัญชีผู้ใช้</th>
                            <th>ชื่อ-นามสกุล</th>

                            <th>ผู้ดูแลระบบ</th>
                            <th>ผู้ออกข้อสอบ</th>
                            <th>ผู้คัดกรองข้อสอบ</th>
                            <th>ผู้จัดทำโครงสร้างชุดข้อสอบ</th>
                            <th>ผู้จัดทำชุดข้อสอบ</th>

                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                        @foreach($users as $DBuser)<tr>
                            @if($DBuser['screener']==1)

                            <td>{{$DBuser['id']}}</td>
                            <td>{{$DBuser['name']}}</td>

                            @if($DBuser['admin']==1)
                            <td> &check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['create_question']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif

                            @if($DBuser['screener']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['structure']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['prepare']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif

                            <td><a href="{{action('UsersController@edit', $DBuser['id'])}}" class="btn btn-warning">Edit</a></td>

                            <td>
                                <form method="post" class="delete_form" action="{{action('UsersController@destroy', $DBuser['id'])}}"> {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>


                        </tr>

                        @endif
                        @endforeach
                    </table>
                </div>

                <div class="tab-pane fade" id="menu4" role="tabpanel" aria-labelledby="menu-4">
                    <table class="table table-bordered table-striped" id= "table">
                        <tr>

                            <th>บัญชีผู้ใช้</th>
                            <th>ชื่อ-นามสกุล</th>

                            <th>ผู้ดูแลระบบ</th>
                            <th>ผู้ออกข้อสอบ</th>
                            <th>ผู้คัดกรองข้อสอบ</th>
                            <th>ผู้จัดทำโครงสร้างชุดข้อสอบ</th>
                            <th>ผู้จัดทำชุดข้อสอบ</th>

                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                        @foreach($users as $DBuser)<tr>
                            @if($DBuser['structure']==1)

                            <td>{{$DBuser['id']}}</td>
                            <td>{{$DBuser['name']}}</td>

                            @if($DBuser['admin']==1)
                            <td> &check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['create_question']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif

                            @if($DBuser['screener']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['structure']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['prepare']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif




                            <td><a href="{{action('UsersController@edit', $DBuser['id'])}}" class="btn btn-warning">Edit</a></>

                            <td>
                                <form method="post" class="delete_form" action="{{action('UsersController@destroy', $DBuser['id'])}}"> {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>


                        </tr>

                        @endif
                        @endforeach
                    </table>

                </div>



                <div class="tab-pane fade" id="menu5" role="tabpanel" aria-labelledby="menu-5">
                    <table class="table table-bordered table-striped" id= "table">
                        <tr>

                            <th>บัญชีผู้ใช้</th>
                            <th>ชื่อ-นามสกุล</th>

                            <th>ผู้ดูแลระบบ</th>
                            <th>ผู้ออกข้อสอบ</th>
                            <th>ผู้คัดกรองข้อสอบ</th>
                            <th>ผู้จัดทำโครงสร้างชุดข้อสอบ</th>
                            <th>ผู้จัดทำชุดข้อสอบ</th>

                            <th>แก้ไข</th>
                            <th>ลบ</th>
                        </tr>
                        @foreach($users as $DBuser)<tr>
                            @if($DBuser['prepare']==1)

                            <td>{{$DBuser['id']}}</td>
                            <td>{{$DBuser['name']}}</td>

                            @if($DBuser['admin']==1)
                            <td> &check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['create_question']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif

                            @if($DBuser['screener']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['structure']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            @if($DBuser['prepare']==1)
                            <td>&check;</td>
                            @else
                            <td>&cross;</td>
                            @endif


                            <td><a href="{{action('UsersController@edit', $DBuser['id'])}}" class="btn btn-warning">Edit</a></td>

                            <td>
                                <form method="post" class="delete_form" action="{{action('UsersController@destroy', $DBuser['id'])}}"> {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>


                        </tr>

                        @endif
                        @endforeach
                    </table>

                </div>


            </div>

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
</script>





@stop
