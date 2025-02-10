<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\QceformController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportsController;

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

Route::group(['middleware'=>['guest']],function(){
    Route::get('/', function () {
        return view('studlogin');
    });

    Route::get('/emp/admin/login', [LoginController::class,'login'])->name('login');
    Route::get('/student/signin', [LoginController::class,'studentLogin'])->name('studentLogin');
    Route::post('/log/success/emp/stud', [LoginController::class,'empstudlogin'])->name('empstudlogin');
});

Route::group(['middleware'=>['login_empauth']],function(){
    Route::get('/dash-board', [DashboardController::class,'dash'])->name('dash');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

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
        Route::get('/qce-form/pdf/form/view/rated', [QceformController::class, 'qceformprintpdfrated'])->name('qceformprintpdfrated');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/list/view', [UserController::class, 'userStore'])->name('userStore');
        Route::get('/list/fetch/ajaxuser', [UserController::class, 'getUserRead'])->name('getUserRead');
        Route::post('/list/fetch/insert', [UserController::class,'userCreate'])->name('userCreate');
        Route::post('/list/fetch/update', [UserController::class,'userUpdate'])->name('userUpdate');
        Route::post('/list/fetch/delete{id}', [UserController::class,'userDelete'])->name('userDelete');
    });

    Route::prefix('/form/fac')->group(function () {
        Route::get('/evaluation/select', [QCEevalformController::class, 'evalsubjfacStore'])->name('evalsubjfacStore');


        Route::get('/fac/view', [QCEevalformController::class, 'evalformStore'])->name('evalformStore');
        Route::post('/fac/view/rate/fac', [QCEevalformController::class, 'facevalrateformCreate'])->name('facevalrateformCreate');
        Route::get('/fac/view/rate/success/submit', [QCEevalformController::class, 'successfacevalrateform'])->name('successfacevalrateform');
        Route::get('/fac/preview', [QCEevalformController::class, 'previewStore'])->name('previewStore');
    });

    Route::prefix('/qce/report')->group(function () {
        Route::get('/view/search', [ReportsController::class, 'subprintStore'])->name('subprintStore');
        Route::get('/view/search/result', [ReportsController::class, 'subprint_searchresultStore'])->name('subprint_searchresultStore');
        Route::get('/view/search/result/faculty/ajax', [ReportsController::class, 'getfacultylistRead'])->name('getfacultylistRead');
    });
});



