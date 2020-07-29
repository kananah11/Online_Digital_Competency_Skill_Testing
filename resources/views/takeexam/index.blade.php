@extends('master')
@section('title','Welcome to KMUTNB')
@section('content')
<style>


.search {
  text-align: center;
}

.search input, .search button {
  padding: 10px 20px;
  outline: none;
  font-size: 20px;
}

.search input {
  border-radius: 25px 0 0 25px;
  width: 60vw;
  max-width: 600px;


}

.search button {
  border-radius: 0 25px 25px 0;
  margin-left: -5px;
  color: white;
  background-color:black;
  cursor: pointer;

}


@import url("https://fonts.googleapis.com/css?family=Lato:300,700");

.search-box {
  display: flex;
  justify-content: center;
  align-items: center;
  /* height: 100vh; */
}

input[type=search] {
  box-shadow: 10px 10px 4px rgba(0, 0, 0, 0.4);
  background: #ffffff;
  border: 2px solid #e7693b;
  outline: none;
  width: 700px;
  height: 40px;
  border-radius: 15px 0 0 15px;
  font-size: 1.4em;
  font-weight: 300;
  padding: 0px 10px;

  letter-spacing: 2px;
  text-transform: uppercase;
  color: #e7693b;
}

::placeholder {
  color: #81CCE8;
  font-size: .8em;
}

.search-btn {
  box-shadow: 10px 10px 4px rgba(0, 0, 0, 0.4);
  height: 40px;
  width: 55px;
  outline: none;
  border-radius: 0 15px 15px 0;
  background: #e7693b;
  color: #ffffff;
  border: none;
  transition: all 0.3s ease;
}
.search-btn:hover {
  transition: all 0.3s ease;
}
.search-btn:hover i {
  font-size: 2.5em;
}
.search-btn i {
  font-size: 2.3em;
}

.card {

border-color: #e7693b;
border-radius: 15px 15px 15px 15px;
}

.card > .card-header {
    background-color: #e7693b;
    border-color: #e7693b;
    border-radius: 15px 15px 0 0;
    }
    .card > .card-body {

    border-color: #e7693b;
    border-radius:  0 0 15px 15px;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="consubmain container">

<!-- <img align="center" src="/image/KMUTNB-baner.png" width="100%" height="360px" > -->
    @if(\Session::has('errors'))

    <?php

$mas = Session::get('errors');
echo "<script type='text/javascript'> window.alert('$mas');</script>"; ?>


    @endif

    <br>

    <div class="row">
            <div class="col-md-12 m-0 p-0" >
            <br>

            <form   method="post"  action="{{url('takeexam/run')}}" >
      {{csrf_field()}}
      <div class="search-box">
<input type="search" name="test" placeholder="Search here...">
<button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
</div>
<!-- <div class="float-center">
    <div class="search input-group col-12 m-0 p-0 " align="center" >

        <input autofocus id="searchInput" name="test" type="text" placeholder="ป้อนรหัสชุดข้อสอบ...">
        <div class="input-group-append">
        <button type="submit" class=" btn btn-outline-secondary"><i class="fa fa-search"></i></button>
     </div>
    </div>
    </div> -->
        </form>
           </div>


    </div>




   <br><br>
   <div class="card">
  <div class="card-header">
  <h5 style="color:#FFF;">ประวัติการทำแบบทดสอบ</h5>
  </div>
  <div class="card-body">

  <div class="row">
        <!-- <div class="col-12 col-md-12 pt-4 pb-2 ">
            <div class="d-flex justify-content-between">
                <div class="txt_exam_head">ประวัติการทำแบบทดสอบ</div>
            </div>
        </div> -->


<div class="col-12 pb-3">
    <div class=" h-100 my-0 border_grey_f2">
        <div class="card-body p-0">
        <div class="table-responsive rounded-top h-100">
            <table class="table table_mfl text-center mb-0 table-hover-mfl">
            <thead class="">
                <tr class="bg_grey_DD">
                <th class="m_width_300p txt_m_spac-1p rounded-top-left">การทดสอบ</th>
                <th class="m_width_200p txt_m_spac-1p">วันที่ทำแบบทดสอบ</th>
                <th class="m_width_160p txt_m_spac-1p">ผลการทดสอบ</th>
                <th class="m_width_120p txt_m_spac-1p rounded-top-right">คะแนนที่ได้</th>
                </tr>
            </thead>
            <tbody>
            @if($before==null)

            @endif
            @foreach($before as $row)
                                                           <tr onclick=" window.location.href= &quot;{{action('TakeExamController@ScoreUser', $row->id)}} &quot;" style="cursor: pointer;">
                    <td class="text-left">@foreach($ex as $raw)
                            @if($row->exam_id==$raw['id'])
                           {{$raw['description']}}
                            @endif
                           @endforeach</td>
                    <td class="text-center"><font data-toggle="tooltip" title="" >{{$row->startdatetime}}</font></td>
                    <td class="text-center">{{$row->status}}</td>
                    <td class="text-center"> {{$row->score}}</td>
                    </tr>
                    @endforeach
                        </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>

    </div>
  <!-- <table class="table table-bordered table-striped">
                       <tr>
                           <th>ลำดับที่</th>
                           <th>หัวข้อ</th>
                           <th>คะแนน</th>
                           <th>สถานะ</th>
                           <th>วันที่สอบ</th>
                           <th>ใบรับรอง</th>
                       </tr>
                        <?php $i = 1; ?>
                       @foreach($before as $row) <tr>

                           <td>{{$i}}</td>
                           @foreach($ex as $raw)
                            @if($row->exam_id==$raw['id'])
                           <td>{{$raw['description']}}</td>
                            @endif
                           @endforeach
                           <td>{{$row->score}}</td>
                           <td>{{$row->status}}</td>
                           <td>{{$row->startdatetime}}</td>
                           @if($row->status=='สอบผ่าน')
                           <td><a href="{{action('TakeExamController@downloadPDF',  $row->id)}}" class="btn btn-primary"  >PDF</a></td>
                           @else
                           <td><a   style="color:red;" >สอบไม่ผ่าน</a></td>
                           @endif
                       </tr>
                           <?php $i = $i + 1; ?>
                       @endforeach
                   </table> -->
  </div>
</div>

<br>




</div>
<script type="text/javascript">
function gone(asd){
  var a = asd;
  window.location.href="{{URL::to('/takeexam/a/userscore')}}";
  }

</script>


@stop
