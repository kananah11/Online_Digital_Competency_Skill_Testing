<?php

namespace App\Http\Controllers;

use App\Category;
use App\examination;
use DataTables;
use DB;
use Illuminate\Http\Request;

class ExamStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('screener');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = Category::all()->toArray();

        $i = 0;

        $easy = 0;
        $medium = 0;
        $hard = 0;
        foreach ($cate as $data) {
            $str = DB::table('examinations')->where('cate_id', $data['id'])->where('status', 'อนุมัติ')->get();

            foreach ($str as $do) {
                if ('ง่าย' == $do->degree) {
                    $easy = $easy + 1;
                }
                if ('ปานกลาง' == $do->degree) {
                    $medium = $medium + 1;
                }
                if ('ยาก' == $do->degree) {
                    $hard = $hard + 1;
                }

            }
            $eall[] = $easy;
            $meall[] = $medium;
            $hall[] = $hard;
            $easy = 0;
            $medium = 0;
            $hard = 0;

            $i = $i + 1;
        }

        return view('store.index', compact('eall', 'meall', 'hall', 'i', 'cate'));
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
        $examinations = examination::find($id);
        $list = DB::table('categories')->get();
        return view('store.show', compact('examinations', 'id'))->with('list', $list);
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
    public function update(Request $request)
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
        $examinations = examination::find($id);
        $examinations->delete();
        return redirect()->route('store.index')->with('success', 'ลบข้อมูลเรียบร้อย');
    }

    public function view(Request $request)
    {

        if (request()->ajax()) {

            if (!empty($request->filter_degree) && 'all' != $request->filter_degree) {

                error_log('a');
                $examinations = examination::select(['id', 'questuion', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 'degree', 'status', 'created_at', 'updated_at', 'cate_id', 'name_cate', 'count', 'correct', 'incorrect'])
                    ->where('status', 'อนุมัติ')
                    ->where('degree', $request->filter_degree)
                    ->where('name_cate', $request->filter_topic);
            } elseif (!empty($request->filter_degree) && 'all' == $request->filter_degree) {
                $examinations = examination::select(['id', 'questuion', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 'degree', 'status', 'created_at', 'updated_at', 'cate_id', 'name_cate', 'count', 'correct', 'incorrect'])
                    ->where('status', 'อนุมัติ')
                    ->where('name_cate', $request->filter_topic);

            } else {
                error_log('b');
                $examinations = examination::select(['id', 'questuion', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 'degree', 'status', 'created_at', 'updated_at', 'cate_id', 'name_cate', 'count', 'correct', 'incorrect'])->where('status', 'อนุมัติ');
            }
            error_log('c');
            return Datatables::of($examinations)
                ->addColumn('action', function ($examinations) {
                    return '<a href="' . action('ExamStoreController@show', $examinations->id) . '" class="btn btn btn-success"><i class="glyphicon glyphicon-search"></i> เรียกดู</a>';
                })

                ->editColumn('delete', function ($examinations) {
                    return '<form method="post" class="delete_form" action="' . action('ExamStoreController@destroy', $examinations->id) . '">
       ' . csrf_field() . '
           <input type="hidden" name="_method" value="DELETE"/>
           <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> ลบ</button>
       </form>';
                })

                ->editColumn('updated_at', function ($user) {
                    return $user->updated_at->format('d/m/Y');
                })
                ->filterColumn('updated_at', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(updated_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
                })

                ->rawColumns(['delete' => 'delete', 'action' => 'action'])

                ->make(true);
        }

        //     $examinations = examination::select(['id', 'questuion', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 'degree', 'status', 'created_at', 'updated_at', 'cate_id', 'name_cate', 'count', 'correct', 'incorrect'])->where('status', 'อนุมัติ');

        //     return Datatables::of($examinations)
        //         ->addColumn('action', function ($examinations) {
        //             return '<a href="' . action('ExamStoreController@show', $examinations->id) . '" class="btn btn btn-success"><i class="glyphicon glyphicon-search"></i> เรียกดู</a>';
        //         })

        //         ->editColumn('delete', function ($examinations) {
        //             return '<form method="post" class="delete_form" action="' . action('ExamStoreController@destroy', $examinations->id) . '">
        //    ' . csrf_field() . '
        //        <input type="hidden" name="_method" value="DELETE"/>
        //        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> ลบ</button>
        //    </form>';
        //         })

        //         ->editColumn('updated_at', function ($user) {
        //             return $user->updated_at->format('d/m/Y');
        //         })
        //         ->filterColumn('updated_at', function ($query, $keyword) {
        //             $query->whereRaw("DATE_FORMAT(updated_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
        //         })

        //         ->rawColumns(['delete' => 'delete', 'action' => 'action'])

        //         ->make(true);
    }
    public function display()
    {
        return view('store.index');
    }

}
