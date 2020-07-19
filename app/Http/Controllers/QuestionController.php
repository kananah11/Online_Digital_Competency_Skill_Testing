<?php

namespace App\Http\Controllers;

use App\Category;
use App\examination;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('examiner');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('displaydata');
        // $examinations = examination::with('Category')->orderby('id')->paginate(10);

        // return view('question.index')->with('examinations', $examinations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $list = DB::table('categories')->get();
        $exam_id = Str::random(32);
        return view('question.create', compact('exam_id', 'list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['typename' => 'required',
            'editor1' => 'required',
            'choice1' => 'required',
            'choice2' => 'required',
            'choice3' => 'required',
            'choice4' => 'required',
            'answer' => 'required',
            'degree' => 'required',
            'exam_id' => 'required',

        ]);

        $top = Category::find($request->get('typename'));
        $uid = Auth::user()->id;
        error_log($uid);
        $examinations = new examination(
            [
                'questuion' => $request->get('editor1'),
                'choice1' => $request->get('choice1'),
                'choice2' => $request->get('choice2'),
                'choice3' => $request->get('choice3'),
                'choice4' => $request->get('choice4'),
                'degree' => $request->get('degree'),
                'answer' => $request->get('answer'),
                'cate_id' => $request->get('typename'),
                'status' => $request->get('status'),
                'exam_id' => $request->get('exam_id'),
                'name_cate' => $top->topic,
                'creator' => $uid,
            ]
        );

        $examinations->save();

        return redirect()->route('question.index')->with('success', 'บันทึกข้อมูลเรียบร้อย');
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
        return view('question.show', compact('examinations', 'id'))->with('list', $list);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        error_log("5555");
        $examinations = examination::find($id);

        $exam_id = $examinations->exam_id;

        $list = DB::table('categories')->get();
        $images = DB::table('images')->where('exam_id', $exam_id)->get();

        return view('question.edit', compact('examinations', 'id', 'images'))->with('list', $list);
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
            'exam_id' => 'required',
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
        $examinations->exam_id = $request->get('exam_id');
        $examinations->status = $request->get('status');
        $examinations->name_cate = $top->topic;
        $examinations->creator = Auth::user()->id;
        $examinations->save();
        return redirect()->route('question.index')->with('success', 'อัพเดทเรียบร้อย');
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
        return redirect()->route('question.index')->with('success', 'ลบข้อมูลเรียบร้อย');
    }

}
