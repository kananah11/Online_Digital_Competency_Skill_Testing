<?php

namespace App\Http\Controllers;

use App\examination;
use Auth;
use DataTables;

class DisplayDataController extends Controller
{

    public function index()
    {
        $ids = Auth::user()->id;
        error_log($ids);
        $examinations = examination::select(['id', 'questuion', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 'degree', 'status', 'created_at', 'updated_at', 'cate_id', 'name_cate'])->where('status', 'รอการอนุมัติ')->where('creator', $ids);

        return Datatables::of($examinations)

            ->addColumn('action', function ($examinations) {

                return '<a href="' . action('QuestionController@edit', $examinations->id) . '" class="btn btn btn-primary"><i class="glyphicon glyphicon-edit"></i> แก้ไข</a>
                <a href="' . action('QuestionController@show', $examinations->id) . '" class="btn btn btn-success"><i class="glyphicon glyphicon-search"></i> เรียกดู</a>';

            })

            ->editColumn('delete', function ($examinations) {
                return '<form method="post" class="delete_form" action="' . action('QuestionController@destroy', $examinations->id) . '">
           ' . csrf_field() . '
               <input type="hidden" name="_method" value="DELETE"/>
               <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
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
    public function display()
    {
        return view('displaydata');
    }
}
