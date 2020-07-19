<?php

namespace App\Http\Controllers;

use App\ExamSet;
use App\Exports\ExportReports;
use App\Structure;
use App\UserExamScoreByCat;
use App\UserExamSet;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ScorereportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('creator');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('scorereport.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $show = DB::table('user_exam_sets')->where('exam_id', $id)->get();
        error_log($id);
        $exam = ExamSet::find($id);
        $str = Structure::find($exam->str_id);
        $str_set = DB::table('structure_sets')->where('set_id', $exam->str_id)->get();

        foreach ($str_set as $srt) {
            $a = $srt->easy + $srt->medium + $srt->hard;

        }

        $i = 0;

        if ('[]' != $show) {
            foreach ($show as $data) {

                $exe[$i] = UserExamSet::find($data->id);
                $scoreby[$i] = UserExamScoreByCat::all()->where('userexamset_id', $data->id);

                $i = $i + 1;
            }

            if (0 == $i) {
                $exe = null;
                $scoreby = null;
            }

            return view('scorereport.show', compact('show', 'exe', 'scoreby', 'str', 'str_set'));
        } else {
            return redirect()->route('scorereport.index')->with('errors', "ยังไม่มีผู้สอบเข้าทำชุดข้อสอบนี้");

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function view()
    {

        $examinations = ExamSet::select(['id', 'description', 'str_id']);

        return DataTables::of($examinations)
            ->addColumn('action', function ($examinations) {

                return '<a href="' . action('ScorereportController@show', $examinations->id) . ' "class="btn btn-info"> <i class="glyphicon glyphicon-search"></i> ดูคะแนน </a> ';

            })

            ->editColumn('str_id', function ($examinations) {
                return $examinations->Structure->struc_name;
            })

            ->make(true);
    }

    public function display()
    {
        return view('scorereport.index');
    }

    public function export($id)
    {
        error_log($id);
        return Excel::download(new ExportReports($id), 'report.csv');

    }

}
