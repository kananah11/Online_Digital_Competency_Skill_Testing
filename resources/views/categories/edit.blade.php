@extends('master')
@section('title','จัดการฐานข้อมูล')
@section('content')
<div class="container">
     <br/>

     <div class="card">
  <div class="card-header">
  <h3 align="center">แก้ไขหมวดหมู่</h3>
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

            <form method="post" action="{{action('CategoriesController@update',$id)}}">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="topic" class="form-control" placeholder="ป้อนชื่อ" value="{{$categories->topic}}" />
                </div>

                <div class="form-group">
                    <h2>สถานะ</h2>
                    @if($categories->status==1)
                    <input type="radio" id="active" name="status" value="1" checked="ture" >&nbsp;Active &nbsp; &nbsp;
                    <input type="radio" id="inactive" name="status" value="0">&nbsp;Inactive<br>
                    @else
                    <input type="radio" id="active" name="status" value="1"  >&nbsp;Active &nbsp; &nbsp;
                    <input type="radio" id="inactive" name="status" value="0" checked="ture">&nbsp;Inactive<br>
                    @endif
                </div>
                <div class="form-group"> <input type="submit" class="btn btn-primary" value="Update" />
                </div>
                <input type="hidden" name="_method" value="PATCH" />

            </form>


  </div>
</div>






</div>

@stop
