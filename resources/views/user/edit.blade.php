@extends('master')
@section('title', 'Welcome Homepage')
@section('content')

<div class="container">
<br>
<div class="card">
  <h5 class="card-header" align="center">
  แก้ไขข้อมูลผู้ใชงานระบบ
  </h5>
  <div class="card-body">

    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul> @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif



    <form method="post" action="{{action('UsersController@update', $id)}}">
        {{csrf_field()}}

        <div class="form-group">
            <input type="text" name="id" class="form-control" placeholder="ป้อนบัญชีผู้ใข้" value="{{$users->id}}" />
        </div>



        <div class="form-group">
            <h2>สิทธิการใช้งาน</h2>
            @if( $users->admin==0 && $users->create_question==0 && $users->screener==0  &&  $users->structure==0  &&  $users->prepare==0  )

            <input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
            <input type="text" id="admin"  name='admin' hidden="true">

            <input type="checkbox" id="create_question1" name="create_question1" value="1" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
            <input type="text" id="create_question"  name='create_question' hidden="true">

            <input type="checkbox" id="screener1" name="screener1" value="1" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
            <input type="text"  id="screener"  name='screener' hidden="true">

            <input type="checkbox" id="str1" name="str1" value="1"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
            <input type="text" id="str"  name='str' hidden="true">

            <input type="checkbox" id="prepare1" name="prepare1" value="1"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
            <input type="text" id="prepare"  name='prepare' hidden="true">

            @elseif( $users->admin==0 && $users->create_question==0 && $users->screener==0   &&  $users->structure==0 &&  $users->prepare==1  )

            <input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
            <input type="text" id="admin"  name='admin' hidden="true">

            <input type="checkbox" id="create_question1" name="create_question1" value="1" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
            <input type="text" id="create_question"  name='create_question' hidden="true">

            <input type="checkbox" id="screener1" name="screener1" value="1" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
            <input type="text"  id="screener"  name='screener' hidden="true">

            <input type="checkbox" id="str1" name="str1" value="1"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
            <input type="text" id="str"  name='str' hidden="true">

            <input type="checkbox" id="prepare1" name="prepare1" value="1" checked="ture"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
            <input type="text" id="prepare"  name='prepare' hidden="true">

            @elseif( $users->admin==0 && $users->create_question==0 && $users->screener==0   &&  $users->structure==1 &&  $users->prepare==0  )

            <input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
            <input type="text" id="admin"  name='admin' hidden="true">

            <input type="checkbox" id="create_question1" name="create_question1" value="1" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
            <input type="text" id="create_question"  name='create_question' hidden="true">

            <input type="checkbox" id="screener1" name="screener1" value="1" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
            <input type="text"  id="screener"  name='screener' hidden="true">

            <input type="checkbox" id="str1" name="str1" value="1" checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
            <input type="text" id="str"  name='str' hidden="true">

            <input type="checkbox" id="prepare1" name="prepare1" value="1"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
            <input type="text" id="prepare"  name='prepare' hidden="true">

            @elseif( $users->admin==0 && $users->create_question==0 && $users->screener==0   &&  $users->structure==1 &&  $users->prepare==1  )

            <input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
            <input type="text" id="admin"  name='admin' hidden="true">

            <input type="checkbox" id="create_question1" name="create_question1" value="1" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
            <input type="text" id="create_question"  name='create_question' hidden="true">

            <input type="checkbox" id="screener1" name="screener1" value="1" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
            <input type="text"  id="screener"  name='screener' hidden="true">

            <input type="checkbox" id="str1" name="str1" value="1" checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
            <input type="text" id="str"  name='str' hidden="true">

            <input type="checkbox" id="prepare1" name="prepare1" value="1" checked="ture" > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
            <input type="text" id="prepare"  name='prepare' hidden="true">

            @elseif( $users->admin==0 && $users->create_question==0 && $users->screener==1   &&  $users->structure==0 &&  $users->prepare==0  )

            <input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
            <input type="text" id="admin"  name='admin' hidden="true">

            <input type="checkbox" id="create_question1" name="create_question1" value="1" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
            <input type="text" id="create_question"  name='create_question' hidden="true">

            <input type="checkbox" id="screener1" name="screener1" value="1" checked="ture" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
            <input type="text"  id="screener"  name='screener' hidden="true">

            <input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
            <input type="text" id="str"  name='str' hidden="true">

            <input type="checkbox" id="prepare1" name="prepare1" value="1"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
            <input type="text" id="prepare"  name='prepare' hidden="true">


            @elseif( $users->admin==0 && $users->create_question==0 && $users->screener==1   &&  $users->structure==0 &&  $users->prepare==1  )

            <input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
            <input type="text" id="admin"  name='admin' hidden="true">

            <input type="checkbox" id="create_question1" name="create_question1" value="1" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
            <input type="text" id="create_question"  name='create_question' hidden="true">

            <input type="checkbox" id="screener1" name="screener1" value="1" checked="ture" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
            <input type="text"  id="screener"  name='screener' hidden="true">

            <input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
            <input type="text" id="str"  name='str' hidden="true">

            <input type="checkbox" id="prepare1" name="prepare1" value="1" checked="ture" > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
            <input type="text" id="prepare"  name='prepare' hidden="true">


            @elseif( $users->admin==0 && $users->create_question==0 && $users->screener==1   &&  $users->structure==1 &&  $users->prepare==0  )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1" checked="ture" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1" checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==0 && $users->create_question==0 && $users->screener==1   &&  $users->structure==1 &&  $users->prepare==1  )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1" checked="ture" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1" checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1" checked="ture" > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==0 && $users->create_question==1 && $users->screener==0   &&  $users->structure==0 &&  $users->prepare==0  )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==0 && $users->create_question==1 && $users->screener==0   &&  $users->structure==0 &&  $users->prepare==1  )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"  checked="ture" > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==0 && $users->create_question==1 && $users->screener==0   &&  $users->structure==0 &&  $users->prepare==1  )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"  checked="ture" > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==0 && $users->create_question==1 && $users->screener==0   &&  $users->structure==1 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1" checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"   > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==0 && $users->create_question==1 && $users->screener==0   &&  $users->structure==1 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1" checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"  checked="ture"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==0 && $users->create_question==1 && $users->screener==1   &&  $users->structure==0 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1" checked="ture" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"    > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==0 && $users->create_question==1 && $users->screener==1   &&  $users->structure==0 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1" checked="ture" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"   checked="ture"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==0 && $users->create_question==1 && $users->screener==1   &&  $users->structure==1 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1" checked="ture" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1" checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"     > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==0 && $users->create_question==1 && $users->screener==1   &&  $users->structure==1 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1" checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1" checked="ture" > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1" checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"  checked="ture"    > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==0 && $users->screener==0   &&  $users->structure==0 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"      > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==0 && $users->screener==0   &&  $users->structure==0 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"    checked="ture"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==0 && $users->screener==0   &&  $users->structure==1 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"  checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"     > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==0 && $users->screener==0   &&  $users->structure==1 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"  checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"   checked="ture"   > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==1 && $users->create_question==0 && $users->screener==1   &&  $users->structure==0 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  checked="ture"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"     > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==1 && $users->create_question==0 && $users->screener==1   &&  $users->structure==0 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  checked="ture"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"   checked="ture"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==1 && $users->create_question==0 && $users->screener==1   &&  $users->structure==1 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  checked="ture"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"  checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"     > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==1 && $users->create_question==0 && $users->screener==1   &&  $users->structure==1 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  checked="ture"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"  checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"  checked="ture"   > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==1 && $users->screener==0   &&  $users->structure==0 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"    > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"    > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"     > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==1 && $users->screener==0   &&  $users->structure==0 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"    > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"    > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"   checked="ture"  > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==1 && $users->screener==0   &&  $users->structure==1 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"    > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"    > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==1 && $users->screener==0   &&  $users->structure==1 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"    > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   checked="ture"  > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"    > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==1 && $users->screener==1   &&  $users->structure==0 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  checked="ture"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"     > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"    > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">


@elseif( $users->admin==1 && $users->create_question==1 && $users->screener==1   &&  $users->structure==0 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  checked="ture"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"     > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"  checked="ture"   > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==1 && $users->create_question==1 && $users->screener==1   &&  $users->structure==1 &&  $users->prepare==0 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  checked="ture"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   checked="ture"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1"    > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">

@elseif( $users->admin==1 && $users->create_question==1 && $users->screener==1   &&  $users->structure==1 &&  $users->prepare==1 )

<input type="checkbox" id="admin1" name="admin1" value="1"  checked="ture" > มีสิทธิเป็นผู้ดูแลระบบ <br>
<input type="text" id="admin"  name='admin' hidden="true">

<input type="checkbox" id="create_question1" name="create_question1" value="1"  checked="ture" > มีสิทธิเป็นผู้ออกข้อสอบ<br>
<input type="text" id="create_question"  name='create_question' hidden="true">

<input type="checkbox" id="screener1" name="screener1" value="1"  checked="ture"  > มีสิทธิเป็นผู้คัดกรองข้อสอบ<br>
<input type="text"  id="screener"  name='screener' hidden="true">

<input type="checkbox" id="str1" name="str1" value="1"   checked="ture"   > มีสิทธิเป็นผู้จัดทำโครงสร้างชุดข้อสอบ<br>
<input type="text" id="str"  name='str' hidden="true">

<input type="checkbox" id="prepare1" name="prepare1" value="1" checked="ture"   > มีสิทธิเป็นผู้จัดทำชุดข้อสอบ<br>
<input type="text" id="prepare"  name='prepare' hidden="true">
 @endif


        </div>

        <div class="form-group" align="center">

            <input type="submit" class="btn btn-primary" value="บันทึก" onclick="sum()" />
            <a type="button" href="{{ url('user') }}" class="btn btn-danger" >กลับ</a>
        </div>

        <input type="hidden" name="_method" value="PATCH" />
    </form>
  </div>
</div>



    <script type="text/javascript">

        $(document).ready(function () {


            if (document.getElementById("admin1").checked == true) {
                document.getElementById("admin").value = 1;
            } else if (document.getElementById("admin1").checked == false) {
                document.getElementById("admin").value = 0;
            }

            if (document.getElementById("create_question1").checked == true) {
                document.getElementById("create_question").value = 1;
            } else if (document.getElementById("create_question1").checked == false) {
                document.getElementById("create_question").value = 0;
            }

            if (document.getElementById("screener1").checked == true) {
                document.getElementById("screener").value = 1;
            } else if (document.getElementById("screener1").checked == false) {
                document.getElementById("screener").value = 0;
            }

            if (document.getElementById("prepare1").checked == true) {
                document.getElementById("prepare").value = 1;
            } else if (document.getElementById("prepare1").checked == false) {
                document.getElementById("prepare").value = 0;
            }

            if (document.getElementById("str1").checked == true) {
                document.getElementById("str").value = 1;
            } else if (document.getElementById("str1").checked == false) {
                document.getElementById("str").value = 0;
            }



        });

        function sum() {
            check1();
            check2();
            check3();
            check4();
            check5();
        }

        function check1() {
            var a = 0;

            if (document.getElementById("admin1").checked == true) {
                document.getElementById("admin").value = 1;
            } else if (document.getElementById("admin1").checked == false) {
                document.getElementById("admin").value = 0;
            }
        }

        function check2() {
            if (document.getElementById("create_question1").checked == true) {
                document.getElementById("create_question").value = 1;
            } else if (document.getElementById("create_question1").checked == false) {
                document.getElementById("create_question").value = 0;
            }
        }

        function check3() {
            if (document.getElementById("screener1").checked == true) {
                document.getElementById("screener").value = 1;
            } else if (document.getElementById("screener1").checked == false) {
                document.getElementById("screener").value = 0;
            }
        }

        function check4() {

            if (document.getElementById("prepare1").checked == true) {
                document.getElementById("prepare").value = 1;
            } else if (document.getElementById("prepare1").checked == false) {
                document.getElementById("prepare").value = 0;
            }
        }

        function check5() {

if (document.getElementById("str1").checked == true) {
    document.getElementById("str").value = 1;
} else if (document.getElementById("str1").checked == false) {
    document.getElementById("str").value = 0;
}
}

    </script>

</div>



@endsection
