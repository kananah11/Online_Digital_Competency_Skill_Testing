@extends('master')
@section('title','ออกข้อสอบ')
@section('script')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
 #image_preview{

border: 1px solid black;
border-radius: 5px;
padding: 10px;
display:block;

height:500%;
overflow:"hidden"
}

#image_preview img{
/* height: 250px; */
width: 250px;

padding: 5px;

}



</style>
@stop
@section('content')
<div class="container">
<br>
<div class="card">
  <div class="card-header">
  <h3 align="center">แก้ไขข้อสอบ</h3>
  </div>
  <div class="card-body">
  @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul> @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif




   <h4 align="center">Upload Image for Exam </h4>
   <br />
   <div class="alert" id="message" style="display: none"></div>
   <form method="post" id="upload_form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Select File for Upload</label></td>
       <td width="30"><input type="file" name="select_file" id="select_file" multiple /></td>
       <input type="text" value="{{$examinations->exam_id}}" name='exam_id' hidden="true">
       <td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
      </tr>

      <tr>
       <td width="40%" align="right"></td>
       <td width="30"><span class="text-muted">jpg, png, gif</span></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form>
   <br />
   <div class='row'id="image_preview" >
     @foreach($images as $rows)
                <div class="col-md-4">
                <form method="delete" id="form_show">
                {{ csrf_field()}}
                <input type="button"  onclick="delete2({{$rows->id}},'{{$rows->exam_id}}');" class="close" name="delete" id="delete"  value="x">
                <img align="center" src="/images/{{$rows->image_name}}" class="img-thumbnail" width="300" />
                <br><input type="text"  name="link" value="http://127.0.0.1:8000/images/{{$rows->image_name}}" checked="true" disabled="" size="40">

                <input type="text" value="{{$rows->id}}" name="id" hidden="true">
                </form>
                </div>
                @endforeach
   </div>




            <form method="post" action="{{action('QuestionController@update',$id)}}">
                {{csrf_field()}}
                <label>หมวดหมู่</label>
        <select class="form-control"  style="height: 100%;" name="typename">
            <option value="{{$examinations->cate_id}}">{{$examinations->Category->topic}}</option>
           @foreach($list as $row)

                 @if($row->status==1 && $row->id!=$examinations->cate_id)
                <option value="{{$row->id}}">{{$row->topic}}</option>

                @endif
           @endforeach
        </select>
                <br>


        <h2>โจทย์</h2>

        <div class="form-group">
            <textarea name="editor1" rows="8" cols="80" class="form-control" >{{$examinations->questuion}}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3>ตัวเลือกที่1</h3>
                <div class="form-group">
                    <textarea name="choice1" class="form-control">{{$examinations->choice1}}</textarea>
                </div>
            </div>
             <div class="col-md-6">
                 <h3>ตัวเลือกที่2</h3>
                <div class="form-group">
                    <textarea name="choice2" class="form-control">{{$examinations->choice2}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3>ตัวเลือกที่3</h3>
                <div class="form-group">
                    <textarea name="choice3" class="form-control">{{$examinations->choice3}}</textarea>
                </div>
            </div>
             <div class="col-md-6">
                 <h3>ตัวเลือกที่4</h3>
                <div class="form-group">
                    <textarea name="choice4" class="form-control">{{$examinations->choice4}}</textarea>
                </div>
            </div>
        </div>
        <select class="form-control" style="height: 100%;" name="answer">
            <option value="{{$examinations->answer}}">{{$examinations->answer}}</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>

        </select>

        <div class="form-group">
                    <h2>ระดับความยาก</h2>
                    @if($examinations->degree=='ง่าย')
                    <input type="radio" id="easy" name="degree" value="ง่าย" checked="ture" >&nbsp;ง่าย &nbsp; &nbsp;
                    <input type="radio" id="medium" name="degree" value="ปานกลาง">&nbsp;ปานกลาง &nbsp; &nbsp;
                    <input type="radio" id="hard" name="degree" value="ยาก">&nbsp;ยาก<br>
                    @elseif($examinations->degree=='ปานกลาง')
                    <input type="radio" id="easy" name="degree" value="ง่าย"  >&nbsp;ง่าย &nbsp; &nbsp;
                    <input type="radio" id="medium" name="degree" checked="ture" value="ปานกลาง">&nbsp;ปานกลาง &nbsp; &nbsp;
                    <input type="radio" id="hard" name="degree" value="ยาก">&nbsp;ยาก<br>
                    @elseif($examinations->degree=='ยาก')
                    <input type="radio" id="easy" name="degree" value="ง่าย"  >&nbsp;ง่าย &nbsp; &nbsp;
                    <input type="radio" id="medium" name="degree" value="ปานกลาง">&nbsp;ปานกลาง &nbsp; &nbsp;
                    <input type="radio" id="hard" name="degree" checked="ture" value="ยาก">&nbsp;ยาก<br>
                    @endif
                </div>
                <input type="text" value="รอการอนุมัติ" name='status' hidden="true">
                <input type="text" value="{{$examinations->exam_id}}" name='exam_id' hidden="true">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Update" />
                    <a type="button" href="{{url('question')}}" class="btn btn-danger" >ยกเลิก</a>
                </div>
                <input type="hidden" name="_method" value="PATCH" />

            </form>
  </div>
</div>
</div>
<script>
CKEDITOR.replace('editor1');
CKEDITOR.replace('choice1');
CKEDITOR.replace('choice2');
CKEDITOR.replace('choice3');
CKEDITOR.replace('choice4');


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function delete2( id , exam_id){
console.log(id);
console.log(exam_id);
$.ajax({
    url: "{{ route('ajaxupload.delete') }}",
    method: "POST",
    data: {
            id:id,
            exam_id:exam_id
    },
    dataType: 'JSON',

    success: function (ress)
    {
        var old =JSON.parse (ress.old);
        var old_image = "";
        old.forEach(element => {
            old_image += '<div class="col-md-4">{{ csrf_field()}}<input type="button"  onclick="delete2('+element.id + ',\''+element.exam_id+'\');" class="close" name="delete" id="delete"  value="x"><img align="center" src="/images/' + element.image_name + '" class="img-thumbnail" width="300" /><br><input type="text"  name="link" value="http://127.0.0.1:8000/images/' + element.image_name + '" checked="true" disabled="" size="40"></div>'
        });
        $('#image_preview').html(old_image);

    }
})


}


$(document).ready(function () {

    $('#upload_form').on('submit', function (event) {
        event.preventDefault();

        // console.log(this);
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            url: "{{ route('ajaxupload.action') }}",
            method: "POST",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                $('#message').css('display', 'block');
                $('#message').html(data.message);
                $('#message').addClass(data.class_name);
                $('#uploaded_image').html(data.uploaded_image);
                $('#link').html(data.link);
                var old =JSON.parse (data.old);
                var old_image = "";
                old.forEach(element => {
                        old_image += '<div class="col-md-4">{{ csrf_field()}}<input type="button"  onclick="delete2('+element.id + ',\''+element.exam_id+'\');" class="close" name="delete" id="delete"  value="x"><img align="center" src="/images/' + element.image_name + '" class="img-thumbnail" width="300" /><br><input type="text"  name="link" value="http://127.0.0.1:8000/images/' + element.image_name + '" checked="true" disabled="" size="40"></div>'
                });
                $('#image_preview').html(old_image);

            }
        })
    });

});









</script>

@stop
