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

.m_width_70p {
    min-width: 70px;
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
                <div class="card mb-0 h-100 rounded border_grey_f2 bg_w">
                    <div class="card-body px-2dot5 px-md-3 py-2dot5 pt-md-3 ">



                        <div class="txt_exam_namehead pb-0 " align="center">ผลการสอบ {{$examset->description}}</div>


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


<figure class="snip1192">
<blockquote>                        <div class="d-flex flex-row">
                                    <div class="txt_exam_title m_width_120p">คะแนนทั้งหมด</div>
                                    <div class="txt_exam_title"> ได้&nbsp&nbsp{{$userexamset->score}}%</div>
                                    </div>


                                    @foreach($chuds as $data)
                                    <div class="d-flex flex-row">
                                    <div class="txt_exam_title m_width_120p">
                                     @foreach($list as $cate)
                                     @if($cate->id==$data->cate_id)
                                     {{$cate->topic}}
                                         @endif
                                     @endforeach</div>
                                     @foreach($scorebycate as $co)

                                     @if($co->cate_id == $data->cate_id)
                                     <div class="txt_exam_title">ได้&nbsp&nbsp{{      (((($data->easy+$data->medium+$data->hard)*100)/$chud->count) * $co->score )/100 }}   %</div>
                                       @endif

                                    @endforeach
                                    </div>
                                    @endforeach

</blockquote>
<div class="author">
<img src="{{ URL::asset('/images/pictures/645.png') }}" alt="sq-sample1">
<h5>คะแนนสอบ</h5>
</div>
</figure>

<figure class="snip1192">
<blockquote><br><br> <div class="d-flex  justify-content-center" >
                                          @if($userexamset->status=='สอบไม่ผ่าน')
                                     <h4 style="color: red;" >{{$userexamset->status}}</h4>
                                     @elseif($userexamset->status=='สอบผ่าน')
                                     <h4 style="color: #4CAF50;" >{{$userexamset->status}}</h4>
                                     @else
                                     <h4 >{{$userexamset->status}}</h4>
                                     @endif
                                </div>
                                </blockquote>
<div class="author">
<img src="{{ URL::asset('/images/pictures/456.png') }}" alt="sq-sample29">
<h5>ผลการสอบ</h5>
</div>
</figure>

</div>


<br><br><br>

                        <div align="center" >
                                      @if($userexamset->status=='สอบไม่ผ่าน')

                                     @elseif($userexamset->status=='สอบผ่าน')
                                     <a  href="{{action('TakeExamController@downloadPDF',  $id)}}" class="btn btn-success"  >ใบรับรองการสอบ</a>
                                     @else

                                     @endif


<a  href="{{ url('takeexam') }}" class="btn btn-info"  >กลับ</a>
        </div>



                    </div>
                </div>
            </div>





        </div>
    </div>
</div>






    @stop
