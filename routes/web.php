<?php

use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Club\ClubController;
use App\Http\Controllers\Experience\ExperienceController;
use App\Http\Controllers\Form\FormController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Qualification\QualificationController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Sport\SportController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\StudentClass\StudenClassController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\User\UserController;
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



Route::prefix('admin')->group(function() {

    Route::get('/activity',[ActivityController::class, 'index'])->name('admin.activity');
    Route::get('/book',[BookController::class, 'index'])->name('admin.book');
    Route::get('/calendar',[CalendarController::class, 'index'])->name('admin.calendar');
    Route::get('/club',[ClubController::class, 'index'])->name('admin.club');
    Route::get('/experience',[ExperienceController::class, 'index'])->name('admin.experience');
    Route::get('/form',[FormController::class, 'index'])->name('admin.form');
    Route::get('/grade',[GradeController::class, 'index'])->name('admin.grade');
    Route::get('/qualification',[QualificationController::class, 'index'])->name('admin.qualification');
    Route::get('/role',[RoleController::class, 'index'])->name('admin.role');
    Route::get('/sport',[SportController::class, 'index'])->name('admin.sport');

    Route::prefix('student')->group(function() {
        Route::get('/',[StudentController::class, 'index'])->name('admin.student');
        Route::get('/add',[StudentController::class, 'add'])->name('admin.student.add');
    });

    Route::prefix('teacher')->group(function() {
        Route::get('/',[TeacherController::class, 'index'])->name('admin.student');
        Route::get('/add',[TeacherController::class, 'add'])->name('admin.student.add');
    });

    Route::prefix('staff')->group(function() {
        Route::get('/',[StaffController::class, 'index'])->name('admin.staff');
        Route::get('/add',[StaffController::class, 'add'])->name('admin.staff.add');
    });
    
    Route::get('/student/class',[StudenClassController::class, 'index'])->name('admin.student.class');
    Route::get('/subject',[SubjectController::class, 'index'])->name('admin.subject');
    Route::get('/teacher',[TeacherController::class, 'index'])->name('admin.teacher');
    Route::get('/user',[UserController::class, 'index'])->name('admin.user');
});



Route::get('/', function () {
    return redirect()->route('admin.student');
});

Route::get('/a', function () {
    return view('backend.__layouts.master');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
