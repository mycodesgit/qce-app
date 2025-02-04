<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\QceformController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\QCEevalformController;
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


Route::get('/dash-board', [DashboardController::class,'dash'])->name('dash');

Route::prefix('/conf')->group(function () {
    Route::get('/instruction/view', [InstructionController::class,'instructionStore'])->name('instructionStore');
    Route::get('/instruction/fetch/ajax', [InstructionController::class,'getInstructionRead'])->name('getInstructionRead');
    Route::post('/instruction/insert', [InstructionController::class,'instructionCreate'])->name('instructionCreate');
    Route::post('/instruction/update', [InstructionController::class,'instructionUpdate'])->name('instructionUpdate');
    Route::post('/instruction/delete{id}', [InstructionController::class,'instructionDelete'])->name('instructionDelete');

    Route::get('/category/view', [CategoryController::class,'categoryStore'])->name('categoryStore');
    Route::get('/category/fetch/ajax', [CategoryController::class,'getcategoryRead'])->name('getcategoryRead');
    Route::post('/category/insert', [CategoryController::class,'categoryCreate'])->name('categoryCreate');
    Route::post('/category/update', [CategoryController::class,'categoryUpdate'])->name('categoryUpdate');
    Route::post('/category/delete{id}', [CategoryController::class,'categoryDelete'])->name('categoryDelete');

    Route::get('/question/view', [QuestionController::class,'questionStore'])->name('questionStore');
    Route::get('/question/fetch/ajaxaaa', [QuestionController::class,'getQuestionRead'])->name('getQuestionRead');
    Route::post('/question/insert', [QuestionController::class,'questionCreate'])->name('questionCreate');
    Route::post('/question/update', [QuestionController::class,'questionUpdate'])->name('questionUpdate');
    Route::post('/question/delete{id}', [QuestionController::class,'questionDelete'])->name('questionDelete');

    Route::get('/semester/view', [SemesterController::class,'semesterStore'])->name('semesterStore');
    Route::get('/semester/fetch/ajaxaaa', [SemesterController::class,'getSemesterRead'])->name('getSemesterRead');
    Route::post('/semester/insert', [SemesterController::class,'semesterCreate'])->name('semesterCreate');
    Route::post('/semester/update', [SemesterController::class,'semesterUpdate'])->name('semesterUpdate');
    Route::post('/semester/delete{id}', [SemesterController::class,'semesterDelete'])->name('semesterDelete');
});

Route::prefix('/conf')->group(function () {
    Route::get('/qce-form/pdf', [QceformController::class, 'indexformpdf'])->name('indexformpdf');
    Route::get('/qce-form/pdf/form/view', [QceformController::class, 'qceformprintpdf'])->name('qceformprintpdf');
});

Route::prefix('/users')->group(function () {
    Route::get('/list/view', [UserController::class, 'userStore'])->name('userStore');
    Route::get('/list/fetch/ajaxuser', [UserController::class, 'getUserRead'])->name('getUserRead');
});

Route::prefix('/form/eval')->group(function () {
    Route::get('/fac/view', [QCEevalformController::class, 'evalformStore'])->name('evalformStore');
});

Route::get('/', function () {
    return view('layouts.masterlayouts');
});

