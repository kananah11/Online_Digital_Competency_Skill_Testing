<?php

namespace App\Http\Controllers;

use App\Category;
use App\Structure;
use App\StructureSet;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamStructureController extends Controller
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
        return view('structure.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Category::all()->toArray();
        $id_chud = Str::random(6);
        return view('structure.create', compact('list', 'id_chud'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = $request->get('get');
        $status = 1;
        $sum = 0;
        $this->validate(
            $request,
            [
                'id_chud' => 'required',
                'inputtime' => 'required',
                'struc_name' => 'required',

            ]
        );
        $time = new Structure(
            [
                'struc_name' => $request->get('struc_name'),
                'count' => $sum,
                'time' => $request->get('inputtime'),
                'status' => $status,
            ]
        );

        $time->save();

        $id = $time->id;

        for ($i = 1; $i <= $exam; $i++) {
            //i=1
            $this->validate(
                $request,
                [
                    'id_chud' => 'required',
                    'categories' . $i => 'required',
                    'easy' . $i => 'required',
                    'medium' . $i => 'required',
                    'hard' . $i => 'required',
                ]
            );

            $s1 = $request->get('easy' . $i); //10
            $s2 = $request->get('medium' . $i);
            $s3 = $request->get('hard' . $i);

            $sum = $sum + $s1 + $s2 + $s3;

            for ($y = $i + 1; $y <= $exam; $y++) {
                if ($request->get('categories' . $i) == $request->get('categories' . $y)) {
                    $status = 0;
                    return redirect()->route('structure.create')->with('error', 'Repeat between categories ' . $i . ' and categories ' . $y);

                } else {
                    $status = 1;
                }
            }

        }

        if (1 == $status) {
            for ($i = 1; $i <= $exam; $i++) {
                $exams = new StructureSet(
                    [
                        'set_id' => $id,
                        'cate_id' => $request->get('categories' . $i),
                        'easy' => $request->get('easy' . $i),
                        'medium' => $request->get('medium' . $i),
                        'hard' => $request->get('hard' . $i),
                    ]
                );
                $exams->save();
            }

            $time = Structure::find($id);

            $time->count = $sum;
            $time->save();

            return redirect()->route('structure.index')->with('success', 'บันทึกข้อมูลเรียบร้อย'); //เปลี่ยนหน้าไปที่ create และโยน success ไปที่view
        }

        return redirect()->route('structure.create')->with('error', 'error system');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chud = Structure::find($id);
        $chuds = DB::table('structure_sets')->where('set_id', $id)->get();
        $list = Category::all()->toArray();
        $times = Structure::find($id);
        $sum = 0;

        return view('structure.show', compact('chud', 'id', 'list', 'chuds', 'sum', 'times'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chud = Structure::find($id);
        $chuds = DB::table('structure_sets')->where('set_id', $id)->get();
        $list = Category::all()->toArray();
        $sum = 0;
        return view('structure.edit', compact('chud', 'id', 'list', 'chuds', 'sum'));
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
        $exam = $request->get('get'); //เก็บค่านับช่งอ
        $status = 1; // เก็บค่า status
        $sum = 0; //เก็บผลรวมข้อ
        $chuds = DB::table('structure_sets')->where('set_id', $id)->get(); // เก็บข้อมูลจากดาต้าเบส ที่ มีชุดไอดีเดียวกัน
        $x = 0; //9ัวนับว่าวนเก็บค่าไปกี่ครั้งแล้ว
        $i = 1; //ตัวนับ ช่อง easy1 easy2 easy3 ...
        foreach ($chuds as $row) {
            // ใช้วนอัพเดทข้อมูลที่มีอยู่ในดาต้าเบสอยู่แล้ว
            $id = $row->id; // ดึงไอดีของแต่ละ row มาเก็บไว้เพื่อจะไปหาแล้วอัพเดท
            $x = $x + 1; //วัน1รอบ +1
            if ($i <= $exam) {
                $this->validate(
                    $request,
                    [
                        'id_chud' => 'required',
                        'categories' . $i => 'required',
                        'easy' . $i => 'required',
                        'medium' . $i => 'required',
                        'hard' . $i => 'required',
                    ]
                );
                $s1 = $request->get('easy' . $i);
                $s2 = $request->get('medium' . $i);
                $s3 = $request->get('hard' . $i);
                $sum = $sum + $s1 + $s2 + $s3;
                $exams = StructureSet::find($id); //หา rowที่มี id ตรงกันแล้วอัพเดท
                $exams->set_id = $request->get('id_chud');
                $exams->cate_id = $request->get('categories' . $i);
                $exams->easy = $request->get('easy' . $i);
                $exams->medium = $request->get('medium' . $i);
                $exams->hard = $request->get('hard' . $i);
                $exams->save();
            } else {
                $chud = StructureSet::find($id);
                $chud->delete();
            }
            $i = $i + 1;
        }
        if ($x < $exam) {
            //กรณีที่กดช่องเพิ่ม แล้วมันไม่มีใน database x มันจะน้อย กว่า จำนวนช่องที่นับมาเก็บไว้ได้ เช่นใน database เรามี 3 เราไปเพิ่มมาอีก 2  ตัวนับช่องก็เป็น 5
            // แต่ข้างบนมัน วนไปแค่ 3 ก็ยังเหลืออีก 2 ช่องที่ยังไม่เก็บ
            for ($s = $x + 1; $s <= $exam; $s++) {
                //ให้มันวนเพิ่มจากจำนวนช่องที่เหลือจากข้างบน  อีก 2ช่อง โอเคไหม? exam มันเป็น 5 ตั้งแต่แรกแล้ว
                $this->validate(
                    $request,
                    [
                        'id_chud' => 'required',
                        'categories' . $s => 'required',
                        'easy' . $s => 'required',
                        'medium' . $s => 'required',
                        'hard' . $s => 'required',
                    ]
                );
                $s1 = $request->get('easy' . $s);
                $s2 = $request->get('medium' . $s);
                $s3 = $request->get('hard' . $s);
                $sum = $sum + $s1 + $s2 + $s3;
                $exams = new StructureSet(
                    [
                        'set_id' => $request->get('id_chud'),
                        'cate_id' => $request->get('categories' . $s),
                        'easy' => $request->get('easy' . $s),
                        'medium' => $request->get('medium' . $s),
                        'hard' => $request->get('hard' . $s),
                    ]
                );
                $exams->save();
            }
        }
        $id_time = $request->get('id_chud'); // เก็บในตาราง chudtime ใช่
        $time = Structure::find($id_time);
        $time->id = $request->get('id_chud');
        $time->time = $request->get('inputtime');
        $time->struc_name = $request->get('struc_name');
        $time->count = $sum;
        $time->status = $status;
        $time->save();
        return redirect()->route('structure.index')->with('success', 'บันทึกข้อมูลเรียบร้อย'); //เปลี่ยนหน้าไปที่ create และโยน success ไปที่view

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time = Structure::find($id);
        $time->delete();
        $chuds = DB::table('structure_sets')->where('set_id', $id)->get();
        foreach ($chuds as $row) {
            $id = $row->id;
            $chud = StructureSet::find($id);
            $chud->delete();
        }
        return redirect()->route('structure.index')->with('success', 'ลบข้อมูลเรียบร้อย');

    }
    public function view()
    {

        $examinations = Structure::select(['id', 'count', 'time', 'updated_at', 'status', 'struc_name']);
        return DataTables::of($examinations)
            ->addColumn('action', function ($examinations) {

                if (1 == $examinations->status) {
                    return '<a href="' . action('ExamStructureController@show', $examinations->id) . '" class="btn btn btn-primary"> <i class="glyphicon glyphicon-search"></i>เรียกดู</a>
            <a href="' . action('ExamStructureController@edit', $examinations->id) . ' "class="btn btn-info"> <i class="glyphicon glyphicon-edit"></i>แก้ไข </a> ' .
                    '&nbsp;<a href="' . action('ExamStructureController@statusoff', $examinations->id) . '"class="btn btn-warning"><i class="glyphicon glyphicon-file"></i>ปิดการเข้าถึง</a>';
                } else {
                    return '<a href="' . action('ExamStructureController@show', $examinations->id) . '" class="btn btn btn-primary"> <i class="glyphicon glyphicon-search"></i>เรียกดู</a>
                    <a href="' . action('ExamStructureController@edit', $examinations->id) . ' "class="btn btn-info"> <i class="glyphicon glyphicon-edit"></i>แก้ไข </a>' .
                    '&nbsp;<a href="' . action('ExamStructureController@statuson', $examinations->id) . '"class="btn btn-success"><i class="glyphicon glyphicon-file"></i>เปิดการเข้าถึง</a> ';
                }
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('d/m/Y');
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })
            ->editColumn('delete', function ($examinations) {
                return '<form method="post" class="delete_form" action="' . action('ExamStructureController@destroy', $examinations->id) . '">
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
        return view('structure.index');
    }

    public function statusoff($id)
    {
        $time = Structure::find($id);
        $time->status = 0;
        $time->save();
        return redirect()->route('structure.index');
    }
    public function statuson($id)
    {
        $time = Structure::find($id);
        $time->status = 1;
        $time->save();
        return redirect()->route('structure.index');
    }
}
