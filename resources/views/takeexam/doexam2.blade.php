@extends('master')
@section('title','Welcome to KMUTNB')
@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{ URL::asset('css/button/start.css') }}" rel="stylesheet">
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<style>


.buttonstart:hover {
  background: #fff;
  box-shadow: 0px 2px 10px 5px #1abc9c;
  color: red;
}

.progress {
  padding: 4px;
  background: rgba(0, 0, 0, 0.25);
  border-radius: 6px;
  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
}

.progress-bar {
  height: 16px;
  border-radius: 4px;
	background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
  background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
  background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
  background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
  -webkit-transition: 0.4s linear;
  -moz-transition: 0.4s linear;
  -o-transition: 0.4s linear;
  transition: 0.4s linear;
  -webkit-transition-property: width, background-color;
  -moz-transition-property: width, background-color;
  -o-transition-property: width, background-color;
  transition-property: width, background-color;
  -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
  box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
}

*,
*:after,
*:before {
  box-sizing: border-box;
}

body {

  color: #000021;
  font-size: calc(1em + 1.25vw);
  background-color: #e6e6ef;
}

form {
  display: -webkit-box;
  display: flex;
  flex-wrap: wrap;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
          flex-direction: column;
}

label {
  display: -webkit-box;
  display: flex;
  cursor: pointer;
  font-weight: 500;
  position: relative;
  overflow: hidden;
  margin-bottom: 0.375em;
  /* Accessible outline */
  /* Remove comment to use */
  /*
  	&:focus-within {
  			outline: .125em solid $primary-color;
  	}
  */
}
label span p{

    margin: 0 0 0px;

}
label input {
  position: absolute;
  left: -9999px;
}
label input:checked + span {
  background-color: #d6d6e5;
}
label input:checked + span:before {
  box-shadow: inset 0 0 0 0.4375em #f77100;
}
label span {
  display: -webkit-box;
  display: flex;
  -webkit-box-align: center;
          align-items: center;
  padding: 0.375em 0.75em 0.375em 0.375em;
  border-radius: 99em;
  -webkit-transition: 0.25s ease;
  transition: 0.25s ease;
}
label span:hover {
  background-color: #d6d6e5;
}
label span:before {
  display: -webkit-box;
  display: flex;
  flex-shrink: 0;
  content: "";
  background-color: #fff;
  width: 1.5em;
  height: 1.5em;
  border-radius: 50%;
  margin-right: 0.375em;
  -webkit-transition: 0.25s ease;
  transition: 0.25s ease;
  box-shadow: inset 0 0 0 0.125em #f77100;
}



#button {
  outline: none;
  height: 40px;
  text-align: center;
  width: 130px;
  border-radius: 40px;
  background: #fff;
  border: 2px solid #1ECD97;
  color: #1ECD97;
  letter-spacing: 1px;
  text-shadow: 0;
  font-size: 12px;
  font-weight: bold;
  cursor: pointer;
  -webkit-transition: all 0.25s ease;
  transition: all 0.25s ease;
}
#button:hover {
  color: white;
  background: #1ECD97;
}
#button:active {
  letter-spacing: 4px;
}
.pull-left {
    float: left;
}
.pull-right {
    float: right;
}

</style>

@stop
@section('content')
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>




<div class="container">
<br><br><br>


<div class="row">
<div class="col-md-12" align="center">
<button   class="buttonstart time-spent"  type="button">
<div data-countdown="{{$time->enddatetime}}" style="color:White;" ></div>
</button>
<br><br><br>
<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 top-progress-bar">
            <div class="pull-left"><span class="color-text-4"><span id="per_success">{{Session::get('progress')}}</span>% Complete </span></div>
            <div class="pull-right"><span class="active"><span id="num_current">{{$id}}</span> of {{$count}}                </span></div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div>
                <div class="progress progress-exam-quiz">
                    <div class="progress-bar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:{{Session::get('progress')}}%; background-color: #f27011;">
                        <!-- 0% -->
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- <div class="progress ">
<div class="progress-bar " style="width: {{Session::get('progress')}}%; background-color: #f27011;">
<span class="sr-only"></span>
</div>
</div> -->

</div>
</div>
<br><br><br><br>


<script>
$('[data-countdown]').each(function() {
  var $this = $(this), finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function(event) {
    $this.html(event.strftime('%H:%M:%S'));
  }).on('finish.countdown', function() {
    window.location = '{{ route('takeexam.score')}}';
    });
});
</script>

    <div class="row">
            <div class="col-md-12 m-0 p-0" >
            <?php echo $examination->questuion; ?></div>


    </div>

    <div class="container">
    <div class="row">
    <div class="col-md-12 m-0 p-0">
    @if($answer==null)
	<form>
        @if($section[0]->ch1==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch1==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch1==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch1==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        @if($section[0]->ch2==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch2==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch2==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch2==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        @if($section[0]->ch3==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch3==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch3==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch3==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
		@if($section[0]->ch4==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch4==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch4==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch4==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        </form>

        @elseif($answer==1)

        <form>
        @if($section[0]->ch1==1 )
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch1==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch1==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch1==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        @if($section[0]->ch2==1 )
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch2==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch2==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch2==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        @if($section[0]->ch3==1 )
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch3==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch3==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch3==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
		@if($section[0]->ch4==1 )
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch4==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch4==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch4==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif

        </form>
    @elseif($answer==2)
    <form>

        @if($section[0]->ch1==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch1==2)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch1==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch1==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        @if($section[0]->ch2==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch2==2)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch2==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch2==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        @if($section[0]->ch3==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch3==2)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch3==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch3==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
		@if($section[0]->ch4==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch4==2)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch4==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch4==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        </form>
    @elseif($answer==3)
    <form>
    @if($section[0]->ch1==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch1==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch1==3)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch1==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        @if($section[0]->ch2==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch2==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch2==3)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch2==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        @if($section[0]->ch3==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch3==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch3==3)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch3==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
		@if($section[0]->ch4==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch4==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch4==3)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch4==4)
        <label>
			<input type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        </form>
    @elseif($answer==4)
    <form>
    @if($section[0]->ch1==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch1==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch1==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @elseif($section[0]->ch1==4)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice1; ?></span>
		</label>
        @endif
        @if($section[0]->ch2==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch2==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch2==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @elseif($section[0]->ch2==4)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice2; ?></span>
		</label>
        @endif
        @if($section[0]->ch3==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch3==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch3==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @elseif($section[0]->ch3==4)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice3; ?></span>
		</label>
        @endif
		@if($section[0]->ch4==1 )
        <label>
			<input type="radio" name="radio" onclick="tiktok(1)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @elseif($section[0]->ch4==2)
        <label>
			<input type="radio" name="radio" onclick="tiktok(2)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @elseif($section[0]->ch4==3)
        <label>
			<input type="radio" name="radio" onclick="tiktok(3)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @elseif($section[0]->ch4==4)
        <label>
			<input checked="checked" type="radio" name="radio" onclick="tiktok(4)"/>
			<span>&nbsp;&nbsp;&nbsp;<?php echo $examination->choice4; ?></span>
		</label>
        @endif
        </form>
    @endif

    </div>
    </div>
</div>


<div class="row">
    @if($count==Session::get('next') && $count-1==Session::get('back'))

    <div class="col-6 m-0 p-0">
    <button id="button" onclick="goback()"  >ข้อก่อนหน้า</button>

    </div>
    <div class="col-6 m-0 p-0">

    <div class="float-right">


    <button type="button" id="button" class="btn btn-primary"   data-toggle="modal" data-target="#exampleModalCenter">
 ส่งคำตอบ
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="backgound-color:red;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ยืนยันการส่งคำตอบ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
      คุณทำข้อสอบไป <p id="tam">{{$tam}}</p>จาก {{$count}}&nbsp ข้อ<br>
       คุณต้องการส่งคำตอบหรือไม่ ?
      </div>
      <div class="modal-footer" >
      <div class="float-center">
       <button type="button" class="btn btn-success" onclick="sent()" >ยืนยันการส่งคำตอบ</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
</div>
      </div>
    </div>
  </div>
</div>


    </div>
    </div>



    @elseif(1==Session::get('back')  && 2==Session::get('next') )

    <div class="col-6 m-0 p-0">
    <button id="button"  >ข้อก่อนหน้า</button>

    </div>
    <div class="col-6 m-0 p-0">

    <div class="float-right">
    <button id="button" onclick="gonext()" >ข้อถัดไป</button>

    </div>
    </div>

    @else

    <div class="col-6 m-0 p-0">
    <button id="button" onclick="goback()"  >ข้อก่อนหน้า</button>
    </div>
    <div class="col-6 m-0 p-0">
    <div class="float-right">
    <button id="button" onclick="gonext()" >ข้อถัดไป</button>

    </div>
    </div>


    @endif
</div>




</div>


<script type="text/javascript">


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function goback(){ window.location.href="{{action('TakeExamController@show', Session::get('back'))}}";}
    function sent() {window.location.href="{{ route('takeexam.score')}}";}
    function gonext(){window.location.href="{{action('TakeExamController@show', Session::get('next'))}}"}

    function tiktok(value) {
        $.ajax({
            url: "{{ route('takeexam.answer') }}",
            method: "POST",
            data: {
                value: value,
            },
            dataType: 'JSON',
            success: function (ress)
            {
                var end ={{$count}};
                $('#tam').html(ress.test);
                if(ress.test==end){
                    window.location.reload();

                }
            }
        })

    }



    $('[data-countdown]').each(function() {
  var $this = $(this), finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function(event) {
    $this.html(event.strftime('%H:%M:%S'));
  });
});


</script>




@stop
