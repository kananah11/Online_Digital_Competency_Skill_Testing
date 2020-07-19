<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function index()
    {
        return view('upload1');
    }

//    function action(Request $request)
    //    {
    //     $validation = Validator::make($request->all(), [
    //      'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ]);
    //     if($validation->passes())
    //     {
    //      $image = $request->file('select_file');
    //      $new_name = rand() . '.' . $image->getClientOriginalExtension();
    //      $image->move(public_path('images'), $new_name);
    //      return response()->json([
    //       'message'   => 'Image Upload Successfully',
    //       'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
    //       'class_name'  => 'alert-success'
    //      ]);
    //     }
    //     else
    //     {
    //      return response()->json([
    //       'message'   => $validation->errors()->all(),
    //       'uploaded_image' => '',
    //       'class_name'  => 'alert-danger'
    //      ]);
    //     }
    //    }

    public function upload(Request $request)
    {
        $this->validate($request, ['select_image' => 'required|image|mimes:jpg,png,gif|max:2048']);

        $image = $request->file('select_image');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        return redirect()->route('question.create')->with('successs', 'อัพโหลดไฟล์เรียบร้อยแล้ว')->with('path', $new_name);

    }

}
