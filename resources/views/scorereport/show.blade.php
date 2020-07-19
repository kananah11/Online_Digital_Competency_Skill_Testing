@extends('master')
@section('title','Welcome to KMUTNB')
@section('content')

<div class="container"> <br>
<a class="btn btn-warning" href="{{action('ScorereportController@export', $show[0]->exam_id)}}">Export</a><br><br>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>รหัสประจำตัว</th>
        <th>ชื่อ</th>

    <?php $j = 0;

foreach ($scoreby[$j] as $b) {

    foreach ($str_set as $srt) {

        if ($srt->cate_id == $b->Category->id) {
            $x = (($srt->easy + $srt->medium + $srt->hard) * 100) / $str->count;

            echo '<th>' . $b->Category->topic . '(' . $x . ')</th>';
        }
    }
}

?>
<th>คะแนนรวม(100)</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0; ?>
   @foreach ($show as $loan)

        <tr>
           <td >{{ $loan->user_id }}</td>
           <td>{{$exe[$i]->User->name}}</td>

<?php
foreach ($scoreby[$i] as $s) {

    foreach ($str_set as $srt) {

        if ($srt->cate_id == $s->cate_id) {
            $x = (($srt->easy + $srt->medium + $srt->hard) * 100) / $str->count;

            echo "<td >" . ($s->score * $x) / 100 . "</td>";
        }
    }

}

?>

<td >{{ $loan->score}}</td>

        </tr>
        <?php $i = $i + 1; ?>
    @endforeach
    </tbody>
   </table>


   <a type="button" href="{{ url('scorereport') }}" class="btn btn-info" >กลับ</a>

</div>



@stop
