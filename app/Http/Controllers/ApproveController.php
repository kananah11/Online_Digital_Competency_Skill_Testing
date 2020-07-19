<?php

namespace App\Http\Controllers;

use App\Category;
use App\examination;
use DB;
use Illuminate\Http\Request;

class ApproveController extends Controller
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
        return view('displayapprove');
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
        return view('approve.show', compact('examinations', 'id'))->with('list', $list);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $examinations = examination::find($id);
        $exam_id = $examinations->exam_id;

        $list = DB::table('categories')->get();
        $images = DB::table('images')->where('exam_id', $exam_id)->get();

        return view('approve.edit', compact('examinations', 'id', 'images'))->with('list', $list);
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
        $this->validate($request, ['typename' => 'required',
            'editor1' => 'required',
            'choice1' => 'required',
            'choice2' => 'required',
            'choice3' => 'required',
            'choice4' => 'required',
            'answer' => 'required',
            'degree' => 'required',
            'status' => 'required',
        ]);
        $top = Category::find($request->get('typename'));
        $examinations = examination::find($id);
        $examinations->cate_id = $request->get('typename');
        $examinations->questuion = $request->get('editor1');
        $examinations->choice1 = $request->get('choice1');
        $examinations->choice2 = $request->get('choice2');
        $examinations->choice3 = $request->get('choice3');
        $examinations->choice4 = $request->get('choice4');
        $examinations->answer = $request->get('answer');
        $examinations->degree = $request->get('degree');
        $examinations->status = $request->get('status');
        $examinations->name_cate = $top->topic;
        $examinations->count = 0;
        $examinations->correct = 0;
        $examinations->incorrect = 0;
        $examinations->save();
        return redirect()->route('approve.index')->with('success', 'อัพเดทเรียบร้อย');
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
    public function add($id)
    {

        $examinations = examination::find($id);
        $examinations->status = 'อนุมัติ';
        $examinations->count = 0;
        $examinations->correct = 0;
        $examinations->incorrect = 0;
        $examinations->save();
        return redirect()->route('approve.index')->with('success', 'อัพเดทเรียบร้อย');
    }

    public function non($id)
    {

        $examinations = examination::find($id);
        $examinations->delete();
        return redirect()->route('approve.index')->with('success', 'อัพเดทเรียบร้อย');
    }
}
