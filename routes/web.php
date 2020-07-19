<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::resource('/categories', 'CategoriesController');

Route::resource('/question', 'QuestionController');

Route::resource('/approve', 'ApproveController');

Route::resource('/store', 'ExamStoreController');

Route::resource('/structure', 'ExamStructureController');

Route::resource('/examset', 'ExamSetController');

Route::resource('/scorereport', 'ScorereportController');

Route::resource('/takeexam', 'TakeExamController');
Route::get('/', 'TakeExamController@index');
Route::resource('/user', 'UsersController');

Route::resource('/report', 'ReportController');

// Route::get('/upload', 'UploadController@index');
// Route::post('/upload', 'UploadController@upload');

//Route::get('/question/create', 'AjaxUploadController@index');
Route::post('/up', 'AjaxUploadController@action')->name('ajaxupload.action');
Route::post('/question/create', 'AjaxUploadController@delete')->name('ajaxupload.delete');

Route::get('/time', function () {
    return view('time');
});
Route::post('/takeexam', 'TakeExamController@ans')->name('takeexam.answer');
Route::get('/score', 'TakeExamController@score')->name('takeexam.score');
Route::get('displaydata', 'DisplayDataController@display');
Route::get('data', 'DisplayDataController@index');

Route::get('displayapprove', 'DisplayApproveController@display');
Route::get('index', 'DisplayApproveController@index');
Route::get('/approve/{id}/add', 'ApproveController@add');
Route::get('/approve/{id}/non', 'ApproveController@non');

Route::get('displaystore', 'ExamStoreController@display');
Route::get('data/store', 'ExamStoreController@view');

Route::get('displayscore', 'ScorereportController@display');
Route::get('data/score', 'ScorereportController@view');

Route::get('displaystore', 'ExamStructureController@display');
Route::get('data/struc', 'ExamStructureController@view');
Route::get('/structure/{id}/statusoff', 'ExamStructureController@statusoff');
Route::get('/structure/{id}/statuson', 'ExamStructureController@statuson');

Route::get('displaystore', 'ExamSetController@display');
Route::get('data/set', 'ExamSetController@view');
Route::get('/examset/{id}/statusoff', 'ExamSetController@statusoff');
Route::get('/examset/{id}/statuson', 'ExamSetController@statuson');

Route::post('/takeexam/run', 'TakeExamController@run');
Route::post('/takeexam/{id}/start', 'TakeExamController@start');
Route::get('/takeexam/{id}/userscore', 'TakeExamController@ScoreUser');
Route::get('/login', 'LoginController@index')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::post('/', 'LoginController@checklogin');
Route::get('login/successlogin', 'LoginController@successlogin');

Route::post('/reports', 'ReportController@status')->name('report.status');

Route::get('/downloadPDF/{id}', 'TakeExamController@downloadPDF')->name('PDF');

//คะแนนสอบ
Route::get('/test', function () {
    return view('takeexam.test');
});

Route::get('/downloadCSV/{id}', 'ScorereportController@export')->name('export');
