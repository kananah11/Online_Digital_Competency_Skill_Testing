<!DOCTYPE html>
<html>

    <head>
        <title>@yield('title')</title>
        @yield('script')
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="shortcut icon" href="{{ URL::asset('/images/pictures/kmutnb.png') }}">
        <!-- ploy -->


        <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@500&display=swap" rel="stylesheet">

        {{-- table.css --}}
        <link href="{{ URL::asset('css/table/main.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/navbar/navbar.css') }}" rel="stylesheet">

        <style>
            body,
            header{
                font-family: 'Bai Jamjuree', sans-serif;

            }
            .li {
                font-family: 'Bai Jamjuree', sans-serif;
            }
            .nav li {
                font-family: 'Bai Jamjuree', sans-serif;
            }
            .coupon {
                border: 5px dotted rgb(168, 63, 63);
                width: 80%;
                border-radius: 15px;
                margin: 0 auto;
                max-width: 600px;
            }
            .promo {
                background: #ccc;
                padding: 3px;
            }
            .expire {
                color: red;
            }

            .head-block {
                margin: 0;
                background: #f77100;
                padding: 12px 0;
            }
            .company-name-th {
                color: #fff;

                font-weight: normal;
                line-height: 0;
            }
            .company-name-en {
                color: #fff;

                line-height: 22px;
                font-weight: normal;
            }
            .navbo {
                margin: 0;
                background: #292B2C;

            }
            .showname {
                color: #fff;

                font-weight: normal;
                line-height: 0;
            }
            .nav-link:hover {
                background: #f77100;
  box-shadow: 0px 2px 10px 5px #F77100;
  color: #000;
            }

            #namenav {
                color: #fff;
                border-radius: 55px;
                font-weight: normal;
                cursor: pointer;

            }
        a{
            cursor: pointer;
        }


            .right {
  float: right;
  width: 300px;
  padding: 10px;
}
#lis li{

    border-bottom: 0.01px solid #F8F8FF;
}


.company-name {
    margin: 0;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;

}


        </style>



    </head>

    <body >
    @if (!Auth::check())
    <script>
    var timeout = ({{config('session.lifetime')}} * 60000) -10 ;
    setTimeout(function(){
        window.location='{{ route('login')}}';
    },  timeout);



    </script>
@endif
        <header>


<!--     <img align="center" src="/image/KMUTNB.png" width="100%">-->
            <section class="head-block">

                <div class="container-fluid">
                    <div class="container">
                        <div class="head-block-wrapper">
                            <div class="row">


                                <div class="col-md-1.5 logo ">
                                    <img  src="/images/pictures/kmutnb_Logo.png" >
                                </div>

                                <div class="col-md-6 company-name ">
                                <div class="float-center pr-3 mt-2 ">

                                <!--
                                <span class="company-name-en">King Mongkut's Test for Digital Literacy</span> -->

                                <span class="company-name-en">KING MONGKUT'S UNIVERSITY OF TECHNOLOGY NORTH BANGKOK TEST FOR DIGITAL LITERACY</span>
                                   <br>
                                   <span class="company-name-th">ระบบการสอบทักษะความเข้าใจและใช้เทคโนโลยีดิจิทัล</span>
                                    </div>
                                </div>
                                @if(Auth::check())
                                <div  class="right col-md-3.5 "  >
<div class="float-right">
<ul   id="namenav" class="nav  pt-3 my-auto">

<li  class="nav-item dropdown">
    <a  class="nav-link dropdown-toggle" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ url('takeexam') }}">ทำข้อสอบ</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{route('logout')}}">ออกจากระบบ</a>
    </div>
</li>
</ul>
</div>


                                </div>

                            @else
                            <script>
    var timeout = ({{config('session.lifetime')}} * 60000) -10 ;
    setTimeout(function(){
        window.location='{{ route('login')}}';
    },  timeout);



    </script>


                                @endif
                                </div>
                            </div>
                        </div>
                    </div>

            </section>


            <div class="navbo container-fluid">
                <div class="container">
                    <nav role="navigation" id="nav">
                        <input class="trigger" type="checkbox" id="mainNavButton">
                        <label for="mainNavButton" onclick>Menu</label>
                        <ul>
                        @if(Auth::check())

                                @if(Auth::user()->admin==1||Auth::user()->create_question==1||Auth::user()->screener==1||Auth::user()->structure==1||Auth::user()->prepare==1)
                                <li id='lis'><a >จัดการข้อสอบ</a>
                                <ul>
                                @if(Auth::user()->admin==1)
                                    <li ><a href="{{ url('categories') }}">หมวดหมู่</a></li>
                                @endif
                                @if(Auth::user()->structure==1)
                                    <li><a href="{{ url('structure') }}">โครงสร้างชุดข้อสอบ</a></li>
                                    @endif
                                    @if(Auth::user()->prepare==1)
                                    <li><a href="{{ url('examset') }}">ชุดข้อสอบ</a></li>
                                    @endif

                                @if(Auth::user()->screener==1)
                                    <li><a href="{{ url('approve') }}">อนุมัติข้อสอบ</a></li>
                                @endif
                                @if(Auth::user()->screener==1)
                                    <li><a href="{{ url('store') }}">คลังข้อสอบ</a></li>
                                @endif
                                 @if(Auth::user()->create_question==1)
                                    <li><a href="{{ url('question') }}">ออกข้อสอบ</a></li>
                                @endif


                                    @if(Auth::user()->prepare==1)
                                    <li><a href="{{ url('scorereport') }}">ดูรายงานคะแนนสอบ</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            @if(Auth::user()->admin==1)
                            <li id='lis'><a href="">จัดการผู้ใช้งาน</a>
                                <ul>
                                    <li><a href="{{ url('user') }}">ข้อมูลผู้ใช้งาน</a></li>
                                    <li><a href="{{ route('user.create') }}">เพิ่มผู้ใช้งาน</a></li>

                                </ul>
                            </li>
                            @endif
                            <li id='lis'><a >การสอบ</a>
                                <ul>
                                    <li><a href="{{ url('takeexam') }}">ทำข้อสอบ</a></li>
                                </ul>
                            </li>
                            @if(Auth::user()->admin==1)
                            <li id='lis'><a href="{{ url('/report') }}">จัดการใบรับรอง</a>
                                <ul>

                                </ul>
                            </li>
                            @endif


                            @endif
                        </ul>
                    </nav>
                </div>
            </div>





        </header>
        <main>

        <div class="conmain container-fluid" >
 @yield('content')
         </div>
         </main>


    </div>
</body>

<footer>
    @yield('footer')
</footer>

</html>
