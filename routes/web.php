<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\ReportController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');


/**####################################### COURSE ###########################################**/
Route::prefix('course')->group(function () {

    Route::get('/', [CourseController::class, 'index'])->name('course.index');

    Route::post('/add', [CourseController::class, 'store'])->name('course.store');

    Route::put('/edit/{id}/update', [CourseController::class, 'update'])->name('course.update');

    Route::delete('/destroy/{id}', [CourseController::class, 'destroy'])->name('course.destroy');

});
/**####################################### ./COURSE ###########################################**/


/**####################################### TEACHER ###########################################**/
Route::prefix('teacher')->group(function () {

    Route::get('/', [TeacherController::class, 'index'])->name('teacher.index');

    Route::post('/add', [TeacherController::class, 'store'])->name('teacher.store');

    Route::get('/show/{id}', [TeacherController::class, 'show'])->name('teacher.show');

    Route::put('/edit/{id}/update', [TeacherController::class, 'update'])->name('teacher.update');

    Route::delete('/destroy/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

});
/**###################################### ./TEACHER ############################################**/



/**####################################### STUDENT ###########################################**/
Route::prefix('student')->group(function () {

    Route::get('/{id}', [StudentController::class, 'index'])->name('student.index');

    Route::post('/add', [StudentController::class, 'store'])->name('student.store');

    Route::get('/show/{id}', [StudentController::class, 'show'])->name('student.show');

    Route::put('/edit/{id}/update', [StudentController::class, 'update'])->name('student.update');

    Route::delete('/destroy/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

    Route::get('/student_active_groups/{id}', [StudentController::class, 'student_active_groups'])->name('student.student_active_groups');

    Route::get('/student_payments_in_group/{student_id}/{group_id}', [StudentController::class, 'student_payments_in_group'])->name('student.student_payments_in_group');

    Route::post('/student_payment/{id}', [StudentController::class, 'student_payment'])->name('student.student_payment');

    Route::delete('/student_payment_delete/{id}', [StudentController::class, 'student_payment_delete'])->name('student.student_payment_delete');

    Route::get('/ajax_student_payments_datatable', [StudentController::class, 'ajax_student_payments_datatable'])->name('student.ajax_student_payments_datatable');
});
/**###################################### ./STUDENT ############################################**/


/**####################################### GROUP ###########################################**/
Route::prefix('group')->group(function () {

    Route::get('/{id}', [GroupController::class, 'index'])->name('group.index');

    Route::post('/add', [GroupController::class, 'store'])->name('group.store');

    Route::get('/show/{id}', [GroupController::class, 'show'])->name('group.show');

    Route::put('/edit/{id}/update', [GroupController::class, 'update'])->name('group.update');

    Route::delete('/destroy/{id}', [GroupController::class, 'destroy'])->name('group.destroy');

    Route::post('/addStudentInGroup/{id}', [GroupController::class, 'addStudentInGroup'])->name('group.addStudentInGroup');

});
/**###################################### ./GROUP ############################################**/


/**####################################### EXPENSE ###########################################**/
Route::prefix('expense')->group(function () {

    Route::get('/{cost_type}', [ExpenseController::class, 'index'])->name('expense.index')->where('cost_type', '[0-9]+');;

    Route::get('/report', [ExpenseController::class, 'report'])->name('expense.report');

    Route::post('/reportShow', [ExpenseController::class, 'reportShow'])->name('expense.reportShow');

    Route::post('/add', [ExpenseController::class, 'store'])->name('expense.store');

    Route::get('/show/{id}', [ExpenseController::class, 'show'])->name('expense.show');

    Route::put('/edit/{id}/update', [ExpenseController::class, 'update'])->name('expense.update');

    Route::delete('/destroy/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');

});
/**###################################### ./EXPENSE ############################################**/


/**####################################### EXPENSE ###########################################**/
Route::prefix('cost')->group(function () {

    Route::get('/', [CostController::class, 'index'])->name('cost.index');

    Route::post('/add', [CostController::class, 'store'])->name('cost.store');

    Route::get('/show/{id}', [CostController::class, 'show'])->name('cost.show');

    Route::put('/edit/{id}/update', [CostController::class, 'update'])->name('cost.update');

    Route::delete('/destroy/{id}', [CostController::class, 'destroy'])->name('cost.destroy');

});
/**###################################### ./EXPENSE ############################################**/


/**####################################### REPORT ###########################################**/
Route::prefix('report')->group(function () {

    Route::get('/', [ReportController::class, 'index'])->name('report.index');

    Route::post('/show', [ExpenseController::class, 'show'])->name('report.show');

//    Route::get('/show/{id}', [ExpenseController::class, 'show'])->name('report.show');
//
//    Route::put('/edit/{id}/update', [ExpenseController::class, 'update'])->name('report.update');
//
//    Route::delete('/destroy/{id}', [ExpenseController::class, 'destroy'])->name('report.destroy');

});
/**###################################### ./REPORT ############################################**/
