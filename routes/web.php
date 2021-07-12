<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ExpenseController;
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

Route::get('/course', [CourseController::class, 'index'])->name('course.index');

Route::post('/course/add', [CourseController::class, 'store'])->name('course.store');

Route::put('/course/edit/{id}/update', [CourseController::class, 'update'])->name('course.update');

Route::delete('/course/destroy/{id}', [CourseController::class, 'destroy'])->name('course.destroy');

/**####################################### ./COURSE ###########################################**/


/**####################################### TEACHER ###########################################**/

Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');

Route::post('/teacher/add', [TeacherController::class, 'store'])->name('teacher.store');

Route::get('/teacher/show/{id}', [TeacherController::class, 'show'])->name('teacher.show');

Route::put('/teacher/edit/{id}/update', [TeacherController::class, 'update'])->name('teacher.update');

Route::delete('/teacher/destroy/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

/**###################################### ./TEACHER ############################################**/



/**####################################### STUDENT ###########################################**/

Route::get('/student/{id}', [StudentController::class, 'index'])->name('student.index');

Route::post('/student/add', [StudentController::class, 'store'])->name('student.store');

Route::get('/student/show/{id}', [StudentController::class, 'show'])->name('student.show');

Route::put('/student/edit/{id}/update', [StudentController::class, 'update'])->name('student.update');

Route::delete('/student/destroy/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

Route::get('/student/student_active_groups/{id}', [StudentController::class, 'student_active_groups'])->name('student.student_active_groups');

Route::get('/student/student_payments_in_group/{student_id}/{group_id}', [StudentController::class, 'student_payments_in_group'])->name('student.student_payments_in_group');

/**###################################### ./STUDENT ############################################**/


/**####################################### GROUP ###########################################**/

Route::get('/group', [GroupController::class, 'index'])->name('group.index');

Route::post('/group/add', [GroupController::class, 'store'])->name('group.store');

Route::get('/group/show/{id}', [GroupController::class, 'show'])->name('group.show');

Route::put('/group/edit/{id}/update', [GroupController::class, 'update'])->name('group.update');

Route::delete('/group/destroy/{id}', [GroupController::class, 'destroy'])->name('group.destroy');

Route::post('/group/addStudentInGroup/{id}', [GroupController::class, 'addStudentInGroup'])->name('group.addStudentInGroup');


/**###################################### ./GROUP ############################################**/


/**####################################### GROUP ###########################################**/

Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');

Route::post('/expense/add', [ExpenseController::class, 'store'])->name('expense.store');

Route::get('/expense/show/{id}', [ExpenseController::class, 'show'])->name('expense.show');

Route::put('/expense/edit/{id}/update', [ExpenseController::class, 'update'])->name('expense.update');

Route::delete('/expense/destroy/{id}', [ExpenseController::class, 'destroy'])->name('expense.destroy');

//Route::post('/expense/addStudentInGroup/{id}', [GroupController::class, 'addStudentInGroup'])->name('group.addStudentInGroup');


/**###################################### ./GROUP ############################################**/
