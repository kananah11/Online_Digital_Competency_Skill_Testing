@extends('master')
@section('title','Welcome to KMUTNB')
@section('script')


<link href="{{ URL::asset('css/button/start.css') }}" rel="stylesheet">

<style>
@import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css);
@import url(https://fonts.googleapis.com/css?family=Raleway:400,800);
figure.snip1192 {

  position: relative;
  overflow: hidden;
  margin: 10px;
  min-width: 220px;
  max-width: 310px;
  width: 100%;
  color: #333;
  text-align: left;
  box-shadow: none !important;
}
figure.snip1192 * {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
figure.snip1192 img {
  max-width: 100%;
  height: 100px;
  width: 100px;
  border-radius: 50%;
  margin-bottom: 15px;
  display: inline-block;
  z-index: 1;
  position: relative;
}
figure.snip1192 blockquote {
  margin: 0;
  display: block;
  border-radius: 8px;
  position: relative;
  background-color: #fbf5ec;
  padding: 30px 50px 65px 50px;
  font-size: 0.8em;
  font-weight: 500;
  margin: 0 0 -50px;
  line-height: 1.6em;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}

figure.snip1192 blockquote {
  margin: 0;
  display: block;
  border-radius: 8px;
  position: relative;
  background-color: #fbf5ec;
  padding: 30px 50px 65px 50px;
  font-size: 0.8em;
  font-weight: 500;
  margin: 0 0 -50px;
  line-height: 1.6em;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}



figure.snip1192 .author {
  margin: 0;
  text-transform: uppercase;
  text-align: center;
  color: #000000;
}
figure.snip1192 .author h5 {
  opacity: 0.8;
  margin: 0;
  font-weight: 800;
}
figure.snip1192 .author h5 span {
  font-weight: 400;
  text-transform: none;
  display: block;
}


figure.snip1193 {

position: relative;
overflow: hidden;
margin: 10px;
min-width: 220px;
max-width: 310px;
width: 100%;
color: #333;
text-align: left;
box-shadow: none !important;
}
figure.snip1193 * {
-webkit-box-sizing: border-box;
box-sizing: border-box;
}
figure.snip1193 img {
max-width: 100%;
height: 100px;
width: 100px;
border-radius: 50%;
margin-bottom: 15px;
display: inline-block;
z-index: 1;
position: relative;
}
figure.snip1193 blockquote {
margin: 0;
display: block;
border-radius: 8px;
position: relative;
background-color: #fbf5ec;
padding: 30px 50px 65px 50px;
font-size: 0.8em;
font-weight: 500;
margin: 0 0 -50px;
line-height: 1.6em;
box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}

figure.snip1193 blockquote {
margin: 0;
display: block;
border-radius: 8px;
position: relative;
background-color: #fbf5ec;
padding: 30px 50px 65px 50px;
font-size: 2em;
/* font-weight: 500; */
margin: 0 0 -50px;
line-height: 1.6em;
box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}



figure.snip1193 .author {
margin: 0;
text-transform: uppercase;
text-align: center;
color: #000000;
}
figure.snip1193 .author h5 {
opacity: 0.8;
margin: 0;
font-weight: 800;
}
figure.snip1193 .author h5 span {
font-weight: 400;
text-transform: none;
display: block;
}
body {
  background-color: #212121;
}
.txt_exam_namehead {

    font-size: 28px;
    color: #cc0000;
    line-height: 1.35em;
}
.m_width_120p {
    min-width: 120px;
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



    blockquote{

height:200px;

}
</style>
@stop

    @section('content')
    <!-- <img align="center" src="/image/KMUTNB-baner.png" width="100%" height="360px" > -->


    <br>
    <div>
    <div class="container pt-0 pt-md-0 pt-lg-0">
        <div class="row">
            <div class="col-12 col-md-12 pb_me-3">
                <div class="card ">
                    <div class="card-body  ">



                        <div class="txt_exam_namehead pb-0 " align="center">{{$test->description}}</div>


                        <hr class="mt-2 mb-2">
                        <div class="d-flex justify-content-start justify-content-lg-between flex-column flex-md-row align-items-md-end align-items-start">
                            <div>





                            </div>


                        </div>
                        <div class="d-flex justify-content-center" id="jj">

<figure class="snip1192">
<blockquote>                        <div class="d-flex flex-row">
                                    <div class="txt_exam_title m_width_120p">จำนวนข้อทั้งหมด</div>
                                    <div class="txt_exam_title">{{$chud->count}} ข้อ 100%</div>
                                    </div>


                                    @foreach($chuds as $data)
                                    <div class="d-flex flex-row">
                                    <div class="txt_exam_title m_width_120p">
                                     @foreach($list as $cate)
                                     @if($cate->id==$data->cate_id)
                                     {{$cate->topic}}
                                         @endif
                                     @endforeach</div>
                                    <div class="txt_exam_title">{{$data->easy+$data->medium+$data->hard}}  ข้อ   {{(($data->easy+$data->medium+$data->hard)*100)/$chud->count }} %</div>
                                    </div>
                                    @endforeach

</blockquote>
<div class="author">
<img src="{{ URL::asset('/images/pictures/4567.png') }}" alt="sq-sample1">
<h5>หมวดหมู่</h5>
</div>
</figure>
<figure class="snip1193 hover">
<blockquote>
<div class="d-flex  justify-content-center" style=" ">
                                    <!-- <div class="txt_exam_title m_width_120p">เวลาในการสอบ</div> -->
                                    <div class="txt_exam_title">{{$chud->time}} นาที</div>
                                </div>
                                </blockquote>
<div class="author">
<img src="{{ URL::asset('/images/pictures/789.png') }}" alt="sq-sample24">
<h5>เวลาในการสอบ</h5>
</div>
</figure>
<figure class="snip1193">
<blockquote><div class="d-flex  justify-content-center">
                                    <!-- <div class="txt_exam_title m_width_120p">คะแนนผ่าน</div> -->
                                    <div class="txt_exam_title"> {{$test->pass}} %</div>
                                </div>
                                </blockquote>
<div class="author">
<img src="{{ URL::asset('/images/pictures/456.png') }}" alt="sq-sample29">
<h5>คะแนนผ่าน</h5>
</div>
</figure>

</div>




    <div align="center">
        <form method="post" action="{{action('TakeExamController@start',$id)}}">
    {{csrf_field()}}
    <div class="form-group">
        <input type="text" name="test" class="form-control"value="{{$id}}" hidden />
    </div>
    <div class="form-group">
        <input type="submit" class="buttonstart" value="START" />
    </div>
</form>

        </div>



                    </div>
                </div>
            </div>





        </div>
    </div>
</div>






    @stop
