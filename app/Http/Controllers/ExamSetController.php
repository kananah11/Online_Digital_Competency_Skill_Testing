<?php

namespace App\Http\Controllers;

use App\ExamSet;
use App\Structure;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamSetController extends Controller
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
        return view('examset.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Structure::all()->toArray();
        $id_set = Str::random(7);
        return view('examset.create', compact('list', 'id_set'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $status = 1;
        $this->validate($request, [
            'id_set' => 'required',
            'description' => 'required',
            'str_id' => 'required',
            'pass' => 'required',

        ]);

        $examinations = new ExamSet(
            [
                'id' => $request->get('id_set'),
                'description' => $request->get('description'),
                'str_id' => $request->get('str_id'),
                'status' => $status,
                'pass' => $request->get('pass'),
            ]
        );

        $examinations->save();
        return redirect()->route('examset.index')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = Structure::all()->toArray();

        $examset = ExamSet::find($id);
        return view('examset.edit', compact('list', 'examset', 'id'));
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
        error_log('11212');
        $this->validate($request, [
            'id_set' => 'required',
            'description' => 'required',
            'str_id' => 'required',
            'pass' => 'required',

        ]);

        $exam = ExamSet::find($id);
        $exam->id = $request->get('id_set');
        $exam->description = $request->get('description');
        $exam->str_id = $request->get('str_id');
        $exam->pass = $request->get('pass');
        $exam->save();
        return redirect()->route('examset.index')->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examinations = ExamSet::find($id);
        $examinations->delete();
        return redirect()->route('examset.index')->with('success', 'ลบข้อมูลเรียบร้อย');
    }
    public function view()
    {

        $examinations = ExamSet::select(['id', 'description', 'updated_at', 'status']);
        return DataTables::of($examinations)
            ->addColumn('action', function ($examinations) {

                if (1 == $examinations->status) {
                    return '
            <a href="' . action('ExamSetController@edit', $examinations->id) . ' "class="btn btn-info"> <i class="glyphicon glyphicon-edit"></i>แก้ไข </a> ' .
                    '&nbsp;<a href="' . action('ExamSetController@statusoff', $examinations->id) . '"class="btn btn-warning"><i class="glyphicon glyphicon-file"></i>ปิดการเข้าถึง</a>';
                } else {
                    return '
                    <a href="' . action('ExamSetController@edit', $examinations->id) . ' "class="btn btn-info"> <i class="glyphicon glyphicon-edit"></i>แก้ไข </a>' .
                    '&nbsp;<a href="' . action('ExamSetController@statuson', $examinations->id) . '"class="btn btn-success"><i class="glyphicon glyphicon-file"></i>เปิดการเข้าถึง</a> ';
                }
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('d/m/Y');
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->editColumn('delete', function ($examinations) {
                return '<form method="post" class="delete_form" action="' . action('ExamSetController@destroy', $examinations->id) . '">
       ' . csrf_field() . '
           <input type="hidden" name="_method" value="DELETE"/>
           <button typze="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
       </form>';
            })
            ->editColumn('status', function ($examinations) {
                if (1 == $examinations->status) {
                    return 'เปิด';
                } elseif (0 == $examinations->status) {
                    return 'ปิด';
                }
            })
            ->rawColumns(['delete' => 'delete', 'action' => 'action'])
            ->make(true);
    }

    public function display()
    {
        return view('examset.index');
    }

    public function statusoff($id)
    {
        $time = Examset::find($id);
        $time->status = 0;
        $time->save();
        return redirect()->route('examset.index');
    }
    public function statuson($id)
    {
        $time = Examset::find($id);
        $time->status = 1;
        $time->save();
        return redirect()->route('examset.index');
    }
}
