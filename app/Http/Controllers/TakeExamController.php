<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\examination;
use App\ExamSet;
use App\signature;
use App\Structure;
use App\User;
use App\userexam;
use App\UserExamScoreByCat;
use App\UserExamSet;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use PDF;
use QrCode;
use Session;

class TakeExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['downloadPDF']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $before = DB::table('user_exam_sets')->where('user_id', Session::get('userID'))->orderBy('startdatetime', 'DESC')->get();
        $ex = ExamSet::all()->toArray();

        return view('takeexam.index', compact('before', 'ex'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('takeexam.test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $section = DB::table('userexams')->where('numexam', $id)->where('userexamset_id', Session::get('examset_id'))->get();
        $nub = DB::table('userexams')->where('userexamset_id', Session::get('examset_id'))->get();
        $count = count($nub);
        $tam = 0;
        foreach ($nub as $row) {
            if (null != $row->answer) {
                $tam = $tam + 1;
            }

        }
        Session::put('count', $count);
        if ($id != $count) {Session::put('next', $id + 1);} else {Session::put('next', $id);}
        if (1 != $id) {Session::put('back', $id - 1);} else {Session::put('back', $id);}
        $examination = examination::find($section[0]->exam_id);
        Session::put('userexams_id', $section[0]->id);
        $answer = $section[0]->answer;
        $time = UserExamSet::find(Session::get('examset_id'));
        return view('takeexam.doexam2', compact('answer', 'section', 'examination', 'count', 'time', 'id', 'tam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function score()
    {

        $score = 0;
        $make = DB::table('userexams')->where('userexamset_id', Session::get('examset_id'))->get();
        $count = count($make);
        foreach ($make as $data) {
            $answer = $data->answer;
            $solve = examination::find($data->exam_id);
            $userexam = userexam::find($data->id);
            if ($solve->answer == $answer) {
                $score = $score + 1;
                $userexam->score = 1;
                $s = $solve->correct;
                $solve->correct = $s + 1;
            } else {
                $userexam->score = 0;
                $s = $solve->incorrect;
                $solve->incorrect = $s + 1;
            }
            $userexam->save();
            $solve->save();
        }
        $sa = userexam::select("cate_id", DB::raw("avg(userexams.score)*100 as cate_score"))
            ->join("examinations", "userexams.exam_id", "=", "examinations.id")
            ->where("userexamset_id", Session::get('examset_id'))
            ->groupBy("cate_id")
            ->get();

        foreach ($sa as $sc) {

            $jc = DB::table('user_exam_score_by_cats')->where('userexamset_id', Session::get('examset_id'))->where('cate_id', $sc->cate_id)->get();
            error_log($jc);
            if ('[]' != $jc) {

            } else {
                error_log('5555');
                $bycat = new UserExamScoreByCat([
                    'userexamset_id' => Session::get('examset_id'),
                    'cate_id' => $sc->cate_id,
                    'score' => round($sc->cate_score, 2),

                ]);

                $bycat->save();

            }
        }

        $userset = UserExamSet::find(Session::get('examset_id'));

        if (null == $userset->score) {
            $per = ($score * 100.0) / $count;
            $userset->score = round($per, 2);
            $userset->save();

            $pass = ExamSet::find($userset->exam_id);
            if ($per >= $pass->pass) {
                $userset->status = 'สอบผ่าน';
                $satana = "ผ่านการทดสอบ";

            } else {
                $userset->status = 'สอบไม่ผ่าน';
                $satana = "ไม่ผ่านการทดสอบ";
            }
            $userset->save();
            $final = round($per, 2);
        }

        $id = Session::get('examset_id');

        $userexamset = UserExamSet::find($id);
        $scorebycate = DB::table('user_exam_score_by_cats')->where('userexamset_id', $id)->get();

        $examset = ExamSet::find($userexamset->exam_id);

        $u = $examset->str_id;

        $chud = Structure::find($u);

        $chuds = DB::table('structure_sets')->where('set_id', $u)->get();

        $list = DB::table('categories')->get();

        return view('takeexam.score', compact('chud', 'id', 'chuds', 'examset', 'list', 'scorebycate', 'userexamset'));
    }

    public function edit($id)
    {
        //
    }
    public function ans(Request $request)
    {
        $nub = 0;
        $section = DB::table('userexams')->where('userexamset_id', Session::get('examset_id'))->get();
        foreach ($section as $data) {

            if (null != $data->answer) {
                $nub = $nub + 1;
            }

        }
        $pro = (($nub + 1) * 100) / Session::get('count');

        Session::put('progress', $pro);

        $value = $request->get('value');
        $id = Session::get('userexams_id');
        $userexam = userexam::find($id);
        $userexam->answer = $value;
        $userexam->save();

        $nub = DB::table('userexams')->where('userexamset_id', Session::get('examset_id'))->get();
        $count = count($nub);
        $tam = 0;
        foreach ($nub as $row) {
            if (null != $row->answer) {
                $tam = $tam + 1;
            }

        }
        return response()->json([
            'test' => $tam,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ScoreUser($id)
    {
        error_log($id);

        $userexamset = UserExamSet::find($id);
        $scorebycate = DB::table('user_exam_score_by_cats')->where('userexamset_id', $id)->get();

        $examset = ExamSet::find($userexamset->exam_id);

        $u = $examset->str_id;

        $chud = Structure::find($u);

        $chuds = DB::table('structure_sets')->where('set_id', $u)->get();

        $list = DB::table('categories')->get();

        return view('takeexam.user_score', compact('chud', 'id', 'chuds', 'examset', 'list', 'scorebycate', 'userexamset'));

    }

    public function run(Request $request)
    {
        $now = Carbon::now(+7);
        error_log($now);
        $id = $request->get('test');
        if ($test = ExamSet::find($id)) {
            if (1 == $test->status) {
                $userexamset = DB::table('user_exam_sets')->where('exam_id', $id)->where('user_id', Session::get('userID'))->get();

                $u = $test->str_id;

                $chud = Structure::find($u);

                $chuds = DB::table('structure_sets')->where('set_id', $u)->get();

                $list = DB::table('categories')->get();

                $sum = 0;

                if ('[]' != $userexamset) {
                    if ($userexamset[0]->enddatetime < $now) {
                        $score = 0;
                        $make = DB::table('userexams')->where('userexamset_id', $userexamset[0]->id)->get();
                        $count = count($make);
                        foreach ($make as $data) {
                            $answer = $data->answer;
                            $solve = examination::find($data->exam_id);
                            $userexam = userexam::find($data->id);
                            if ($solve->answer == $answer) {
                                $score = $score + 1;
                                $userexam->score = 1;
                            } else {
                                $userexam->score = 0;
                            }
                            $userexam->save();
                        }
                        $sa = userexam::select("cate_id", DB::raw("avg(userexams.score)*100 as cate_score"))
                            ->join("examinations", "userexams.exam_id", "=", "examinations.id")
                            ->where("userexamset_id", $userexamset[0]->id)
                            ->groupBy("cate_id")
                            ->get();

                        foreach ($sa as $sc) {

                            $bycat = new UserExamScoreByCat([
                                'userexamset_id' => $userexamset[0]->id,
                                'cate_id' => $sc->cate_id,
                                'score' => round($sc->cate_score, 2),

                            ]);
                            $bycat->save();
                        }

                        $userset = UserExamSet::find($userexamset[0]->id);
                        $per = ($score * 100.0) / $count;
                        $userset->score = round($per, 2);
                        $userset->save();

                        $pass = ExamSet::find($userset->exam_id);
                        if ($per >= $pass->pass) {
                            $userset->status = 'สอบผ่าน';
                            $satana = "ผ่านการทดสอบ";

                        } else {
                            $userset->status = 'สอบไม่ผ่าน';
                            $satana = "ไม่ผ่านการทดสอบ";
                        }
                        $userset->save();
                        $final = round($per, 2);

                        return redirect()->route('takeexam.index')->with('errors', "หมดเวลาสอบหรือสอบไปแล้ว");
                    }
                    error_log('ทำ');
                    if ('กำลังสอบ' == $userexamset[0]->status) {
                        return view('takeexam.run', compact('chud', 'id', 'chuds', 'sum', 'list', 'test'));
                    } elseif ('สอบผ่าน' == $userexamset[0]->status || 'สอบไม่ผ่าน' == $userexamset[0]->status) {
                        return redirect()->route('takeexam.index')->with('errors', "หมดเวลาสอบหรือสอบไปแล้ว");
                    }

                } else {
                    return view('takeexam.run', compact('chud', 'id', 'chuds', 'sum', 'list', 'test'));
                }
            } else {

                return redirect()->route('takeexam.index')->with('errors', "ชุดข้อสอบถูกปิดการเข้าถึง");
            }
        } else {

            return redirect()->route('takeexam.index')->with('errors', "ไม่มีชุดข้อสอบ");
        }

    }

    public function start(Request $request, $id)
    {
        error_log('5555');
        $user = Session::get('userID');
        error_log(Session::get('userID'));
        $check = DB::table('user_exam_sets')->where('exam_id', $id)->where('user_id', $user)->get();

        if (0 == count($check)) {

            $exam = new UserExamSet([
                'exam_id' => $id,
                'user_id' => $user,
                'status' => 'กำลังสอบ',

            ]);
            $exam->save();
            $userexamset_id = $exam->id;
            $numexam = 1;
            $test = ExamSet::find($id);
            $u = $test->str_id;
            $chud = Structure::find($u);
            $chuds = DB::table('structure_sets')->where('set_id', $u)->get();
            // $list = Category::all()->toArray();
            foreach ($chuds as $data) {
                $cate = $data->cate_id;

                $easy = $data->easy;
                $medium = $data->medium;
                $hard = $data->hard;

                $ex = DB::table('examinations')->where('cate_id', $cate)->where('degree', 'ง่าย')->where('status', 'อนุมัติ')->get(['id'])->toArray();
                $ex = array_map(function ($value) {
                    return (array)$value;
                }, $ex);
                shuffle($ex);
                for ($i = 0; $i < $easy; $i++) {
                    $numbers = range(1, 4);
                    shuffle($numbers);
                    $userexam = new userexam([
                        'userexamset_id' => $userexamset_id,
                        'numexam' => $numexam,
                        'exam_id' => $ex[$i]["id"],
                        'ch1' => $numbers[0],
                        'ch2' => $numbers[1],
                        'ch3' => $numbers[2],
                        'ch4' => $numbers[3],
                        'score' => 0,

                    ]);
                    $examcount = examination::find($ex[$i]["id"]);
                    $p = $examcount->count;
                    $examcount->count = $p + 1;
                    $examcount->save();
                    $userexam->save();
                    error_log(1);
                    $numexam = $numexam + 1;
                }

                $ex = DB::table('examinations')->where('cate_id', $cate)->where('degree', 'ปานกลาง')->where('status', 'อนุมัติ')->get(['id'])->toArray();
                $ex = array_map(function ($value) {
                    return (array)$value;
                }, $ex);
                shuffle($ex);
                for ($i = 0; $i < $medium; $i++) {
                    $numbers = range(1, 4);
                    shuffle($numbers);
                    error_log($ex[$i]["id"]);
                    $userexam = new userexam([
                        'userexamset_id' => $userexamset_id,
                        'numexam' => $numexam,
                        'exam_id' => $ex[$i]["id"],
                        'ch1' => $numbers[0],
                        'ch2' => $numbers[1],
                        'ch3' => $numbers[2],
                        'ch4' => $numbers[3],
                        'score' => 0,

                    ]);
                    $examcount = examination::find($ex[$i]["id"]);
                    $p = $examcount->count;
                    $examcount->count = $p + 1;
                    $examcount->save();
                    $userexam->save();
                    error_log(1);
                    $numexam = $numexam + 1;
                }
                $ex = DB::table('examinations')->where('cate_id', $cate)->where('degree', 'ยาก')->where('status', 'อนุมัติ')->get(['id'])->toArray();
                $ex = array_map(function ($value) {
                    return (array)$value;
                }, $ex);
                shuffle($ex);
                for ($i = 0; $i < $hard; $i++) {
                    $numbers = range(1, 4);
                    shuffle($numbers);
                    $userexam = new userexam([
                        'userexamset_id' => $userexamset_id,
                        'numexam' => $numexam,
                        'exam_id' => $ex[$i]["id"],
                        'ch1' => $numbers[0],
                        'ch2' => $numbers[1],
                        'ch3' => $numbers[2],
                        'ch4' => $numbers[3],
                        'score' => 0,

                    ]);
                    $examcount = examination::find($ex[$i]["id"]);
                    $p = $examcount->count;
                    $examcount->count = $p + 1;
                    $examcount->save();
                    $userexam->save();
                    error_log(1);
                    $numexam = $numexam + 1;
                }

            }

            $now = DB::raw('NOW()');
            $exam->startdatetime = $now;

            // return view('takeexam.test', compact('chud', 'id', 'list', 'chuds'));
            $time = $chud->time;

            $end = DB::raw("DATE_ADD(NOW(), INTERVAL $time MINUTE)");
            $exam->enddatetime = $end;
            $exam->save();
            Session::put('examset_id', $userexamset_id);
        } else {

            $userexamset_id = $check[0]->id;
            Session::put('examset_id', $userexamset_id);

        }
        $numexam = 1;

        $noob = DB::table('userexams')->where('userexamset_id', Session::get('examset_id'))->get();
        $count = count($noob);

        Session::put('progress', 0);
        $nub = 0;
        $section = DB::table('userexams')->where('userexamset_id', Session::get('examset_id'))->get();
        foreach ($section as $data) {

            if (null != $data->answer) {
                $nub = $nub + 1;
            }

        }
        if (0 == $count) {
            $pro = 0;
        } else {
            $pro = ($nub * 100) / $count;
        }

        Session::put('progress', $pro);

        return redirect()->action('TakeExamController@show', $numexam);

    }
    public function downloadPDF($id)
    {
        if ($certificate = Certificate::find($id)) {

            $view = \View::make('takeexam.pdf', compact('certificate'));
        } else {
            QrCode::size(100)
                ->format('png')
                ->generate(url('/downloadPDF/' . $id . ''), public_path('/images/qrcode/qrcode' . $id . '.png'));
            $user = UserExamSet::find($id);
            $signa = signature::where('status', 1)->first();
            $data = User::find($user->user_id);
            $qr = '/images/qrcode/qrcode' . $id . '.png';
            $certificate = new Certificate(
                ['id' => $id,
                    'name' => $data->eng_name,
                    'signa_name' => $signa->name,
                    'signa_pic' => $signa->image,
                    'signa_pos' => $signa->position,
                    'date' => $user->updated_at,
                    'qrcode' => $qr,
                ]
            );
            $certificate->save();
            $view = \View::make('takeexam.pdf', compact('certificate'));
        }
        //โยนตัวแปล user ไปทำงานที่โฟล์เดอร์ (user.pdf)
        $html = $view->render();
        $pdf = new PDF(); // สร้าง PDF
        $pdf::SetTitle('รายงานผล Test PDF');
        $pdf::AddPage('L', 'A4', false, false);
        // -- set new background ---

// get the current page break margin
        $bMargin = $pdf::getBreakMargin();
// get current auto-page-break mode
        $auto_page_break = $pdf::getAutoPageBreak();
// disable auto-page-break
        $pdf::SetAutoPageBreak(false, 0);
// set bacground image

        $pdf::Image('images/pictures/bg-05.jpg', 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
        $pdf::SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
        $pdf::setPageMark();
        //$pdf::SetMargins(0, 10);
        // $pdf::SetHeaderMargin(0);
        // $pdf::SetFooterMargin(0);
        $pdf::SetFont('freeserif'); //ตั้งฟอนภาษาไทย
        $pdf::WriteHTML($html, true, false, true, false); //ตั้งขนาด

        $pdf::Output('report.pdf'); // ดาว์หโหลด PDF จะชื่อ report.pdf

    }

}
