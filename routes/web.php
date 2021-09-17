<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\TuitionController;
use App\Http\Controllers\TypePayController;
use App\Http\Controllers\FrontController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckLoginStudent;

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

//User page
Route::get('/login', [StudentController::class, 'login'])->name("login");
Route::post('/login', [StudentController::class, 'loginProcess'])->name("login-process");
    //Middleware
    Route::middleware([CheckLoginStudent::class])->group(function(){
        
        Route::get('/', function () {
            return view('welcome');
        })->name('welcome');
        Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
        Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
        Route::post('/profile/change', [StudentController::class, 'changePassword'])->name('change.passwordUser');

    });
//End user
//Admin page
// Route::group(['prefix'=>'admin'], function(){
Route::prefix('admin')->group(function(){
    Route::get('/login', [AdminController::class, 'login'])->name("admin.login");
    Route::post('/login-process', [AdminController::class, 'loginProcess'])->name("admin.login-process");
    //Middleware
    Route::middleware([CheckLogin::class])->group(function(){
    
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/edit', [AdminController::class, 'edit'])->name('admin.edit'); 
        Route::post('/update', [AdminController::class ,'update'])->name('admin.update');
        
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        //Send mail to student
        Route::post('/message/send', [FrontController::class, 'addFeedback'])->name('front.fb');
        // Route::resources([
        Route::resource('grade', GradeController::class);
        //Student
        // Route::get('student', [BookController::class,'index']);
        Route::post('/student/import', [StudentController::class,'import'])->name('student.import');
        Route::get('/student/export', [StudentController::class,'export'])->name('student.export');
        Route::get('/student/search', [StudentController::class,'search'])->name('student.search');
        Route::resource('student', StudentController::class);
        //End student
        Route::resource('course', CourseController::class);
        Route::resource('major', MajorController::class);
        //Tuition resource
        // Route::resource('tuition', TuitionController::class);
       //Tuition
        Route::get('tuition/edit/{idCourse,idMajor}', [TuitionController::class,'edit'])->name('tuition.edit');
        Route::get('tuition/create', [TuitionController::class,'create'])->name('tuition.create');
        Route::get('tuition/index', [TuitionController::class,'index'])->name('tuition.index');
        Route::post('tuition/store', [TuitionController::class,'store'])->name('tuition.store');
        Route::post('tuition/update', [TuitionController::class,'update'])->name('tuition.update');
        //End tuition
        Route::resource('scholarship', ScholarshipController::class);
        Route::resource('typepay', TypePayController::class);
 // Route::resource('bill', BillController::class);
        Route::get('create-bill', [BillController::class,'create'])->name('bill.create');
        Route::get('add-bill', [BillController::class,'add'])->name('bill.add');
        // Route::get('create-bill/{id}', 'BillController@add')->name('bill.add');
        Route::get('all-bill', [BillController::class,'index'])->name('bill.index');
        Route::get('store-bill', [BillController::class,'store'])->name('bill.store');
        Route::get('detail-bill/{id}', [BillController::class,'detail'])->name('bill.detail');
        Route::get('filter-bill/{id}', [BillController::class,'filter'])->name('bill.filter');
    });


});
//End admin
