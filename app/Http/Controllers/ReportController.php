<?php

namespace App\Http\Controllers;

use App\signature;
use Illuminate\Http\Request;

class ReportController extends Controller
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
        $signa = signature::all()->toArray();
        return view('report.index', compact('signa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, ['name' => 'required', 'position' => 'required', 'namefile' => 'required']);

        $image = $request->file('namefile');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $signature = new signature(
            [

                'name' => $request->get('name'),
                'position' => $request->get('position'),
                'image' => $new_name,
                'status' => 0,
            ]
        );
        $signature->save(); //บันทึกข้อมูลลงไปในตาราง

        return redirect()->route('report.index')->with('success', 'อัพเดทเรียบร้อย');

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

    public function status(Request $request)
    {
        $id = $request->get('value');
        error_log($id);
        $open = signature::where('status', 1)->first();

        $sta = signature::find($open->id);
        $sta->status = 0;
        $sta->save();
        $signa = signature::find($id);

        if (0 == $signa->status) {
            $signa->status = 1;
            $signa->save();
        } else {
            $signa->status = 0;
            $signa->save();
        }

        return view('report.create');

    }
}
