<?php

namespace App\Http\Controllers;

use App\examination;
use DataTables;

class DisplayApproveController extends Controller
{
    public function index()
    {
        $examinations = examination::select(['id', 'questuion', 'choice1', 'choice2', 'choice3', 'choice4', 'answer', 'degree', 'status', 'created_at', 'updated_at', 'cate_id', 'name_cate'])->where('status', 'รอการอนุมัติ');

        return Datatables::of($examinations)

            ->addColumn('action', function ($examinations) {

                //<a href="' . action('ApproveController@edit', $examinations->id) . '" class="btn btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>

                return '<a href="' . action('ApproveController@show', $examinations->id) . '" class="btn btn btn-success"><i class="glyphicon glyphicon-search"></i> View</a>';

            })

            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('d/m/Y');
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
            })

            ->make(true);
    }
    public function display()
    {
        return view('displayapprove');
    }
}
