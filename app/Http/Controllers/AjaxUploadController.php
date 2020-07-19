<?php

namespace App\Http\Controllers;

use App\images;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

$count = 0;

class AjaxUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index()
    {
        return view('question.create');
    }
    public function delete(Request $request)
    {

        $id = $request->get('id');
        $exam_id = $request->get('exam_id');
        images::find($id)->delete($id);
        $old_image = DB::table('images')->where('exam_id', $exam_id)->get();
        $test = json_encode($old_image);

        return response()->json([
            'message' => 'Image Delete Successfully',
            // 'uploaded_image' => '<img src="/images/' . $new_name . '" class="img-thumbnail" width="300" />',
             'class_name' => 'alert-success',
            // 'link' => '<input type="text"  name="link" value="http://127.0.0.1:8000/images/' . $new_name . '" checked="ture" disabled="" size="40">',
             'old' => $test,
        ]);

    }

    public function action(Request $request)
    {
        error_log('or');

        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validation->passes()) {

            error_log('if');
            $exam_id = $request->get('exam_id');
            error_log($exam_id);

            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $imagedb = new images(
                [
                    'image_name' => ($new_name),
                    'exam_id' => ($exam_id),
                ]);
            $imagedb->save();
            $old_image = DB::table('images')->where('exam_id', $exam_id)->get();
            $test = json_encode($old_image);

            return response()->json([
                'message' => 'Image Upload Successfully',
                // 'uploaded_image' => '<img src="/images/' . $new_name . '" class="img-thumbnail" width="300" />',
                 'class_name' => 'alert-success',
                // 'link' => '<input type="text"  name="link" value="http://127.0.0.1:8000/images/' . $new_name . '" checked="ture" disabled="" size="40">',
                 'old' => $test,
            ]);

        } else {
            error_log('else');
            return response()->json([
                'message' => 'required|image|mimes:jpg,png,gif|max:2048',
                'uploaded_image' => 'ต้องเป็นภาพเท่านั้น !',
                'class_name' => 'alert-danger',
            ]);

        }
    }
}
