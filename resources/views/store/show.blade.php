@extends('master')
<blade
    section|(%26%2339%3Btitle%26%2339%3B%2C%26%2339%3B%E0%B8%AD%E0%B8%AD%E0%B8%81%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%AA%E0%B8%AD%E0%B8%9A%26%2339%3B) />
@section('script')
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<style>
 label{

    color : red;

 }


</style>
@stop
    @section('content')
    <div class="container">
<br>
<div class="card">
<h3 class="card-header" align="center">ข้อสอบ</h3> <br />
  <div class="card-body">
  <form method="get" action="{{action('QuestionController@edit',$id)}}" class="col-12 m-0 p-0">
                {{csrf_field()}}

                <div class="form-group">
                    <label class="control-label" for="">หมวดหมู่</label>
                    <input type="text"  class="form-control" name="typename" value="{{$examinations->Category->topic}}" checked="ture" disabled="" >

                </div>
                <br>


                <div class="form-group">
                <label class="control-label" >โจทย์</label>
                    <?php echo $examinations->questuion; ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label class="control-label" >ตัวเลือกที่1</label>
                        <div class="form-group">
                            <?php echo $examinations->choice1; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <label class="control-label" >ตัวเลือกที่2</label>
                        <div class="form-group">
                            <?php echo $examinations->choice2; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label class="control-label" >ตัวเลือกที่3</label>
                        <div class="form-group">
                            <?php echo $examinations->choice3; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <label class="control-label" >ตัวเลือกที่4</label>
                        <div class="form-group">
                            <?php echo $examinations->choice4; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                <label class="control-label" for="ans" >เฉลย</label>
                    <input type="text"  id="ans" class="form-control" name="answer" value="ข้อที่ {{$examinations->answer}}" checked="ture" disabled="" >

                </div>



                <div class="form-group">
                <label class="control-label" for="easy" >ระดับ</label>
                    @if($examinations->degree=='ง่าย')
                    <input type="text" id="easy" class="form-control" name="degree" value="ง่าย" checked="ture" disabled="" >
                    @elseif($examinations->degree=='ปานกลาง')
                    <input type="text" id="easy"  class="form-control"name="degree" value="ปานกลาง" checked="ture" disabled="" >
                    @elseif($examinations->degree=='ยาก')
                    <input type="text" id="easy" class="form-control" name="degree" value="ยาก" checked="ture" disabled="" >
                    @endif
                </div>

                <div class="form-group" align="center">
        <a type="button" href="{{ url('store') }}" class="btn btn-info"><i
                class="glyphicon glyphicon-share-alt"></i> กลับ</a>

    </div>




            </form>

  </div>
</div>




</div>







@stop
