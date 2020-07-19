@extends('master')
@section('title', 'compo')
@section('script')

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="{{ URL::asset('css/dist/main.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/dist/custom.css') }}" rel="stylesheet">

@stop
@section('content')

    <div class="container" align="center">
        <div class="row">
        <br><br><br>
            <h3 >คะแนนสอบ</h3>
            <div id="circle1" class="circle-default-style"></div>
            <h3 > คะแนนที่ได้<span class="promo">60</span></h3>
            <h3 class="expire">ไม่ผ่านการทดสอบ</h3>
        </div>
    </div>


    <script type="text/javascript" src="{{ ('css/dist/circliful.js') }}"></script>
    <script>
        (function () {
            var circle1 = circliful.newCircle({
                id: 'circle1',
                type: 'simple',
                percent: 100,
                strokeGradient: ["#05a", "#0a5"],
                onAnimationEnd: () => {
                    console.log('custom animation end event');
                },
                animationStep: 5,
                foregroundCircleWidth: 9,
                backgroundCircleWidth: 9,
                additionalCssClasses: {
                    svgContainer: 'circle1-container',
                    foregroundCircle: 'circle1-foreground-circle',
                    text: 'circle1-text',
                    icon: 'circle1-icon',
                    infoText: 'circle1-info-text'
                },
                icon: 'f0d0',
                text: 'คะแนนสอบ',
                noPercentageSign: true,
                strokeLinecap: "round",
            });


        })();

    </script>



@stop
