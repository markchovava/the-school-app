<?php

use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Club\ClubController;
use App\Http\Controllers\Club\ClubHighcontroller;
use App\Http\Controllers\Club\ClubPrimaryController;
use App\Http\Controllers\Experience\ExperienceController;
use App\Http\Controllers\Form\FormController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Qualification\QualificationController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Sport\SportController;
use App\Http\Controllers\Sport\SportHighController;
use App\Http\Controllers\Sport\SportPrimaryController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\StudentClass\StudenClassController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Subject\SubjectHighController;
use App\Http\Controllers\Subject\SubjectPrimaryController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserTypeController;
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
    Route::get('/sport',[SportController::class, 'index'])->name('admin.sport');

    Route::prefix('grade')->group(function() {
        Route::get('/',[GradeController::class, 'index'])->name('admin.grade');
        Route::get('/search',[GradeController::class, 'search'])->name('admin.grade.search');
        Route::get('/add',[GradeController::class, 'add'])->name('admin.grade.add');
        Route::post('/store',[GradeController::class, 'store'])->name('admin.grade.store');
        Route::get('/edit/{id}',[GradeController::class, 'edit'])->name('admin.grade.edit');
        Route::post('/update/{id}',[GradeController::class, 'update'])->name('admin.grade.update');
        Route::get('/view/{id}',[GradeController::class, 'view'])->name('admin.grade.view');
        Route::get('/delete/{id}',[GradeController::class, 'delete'])->name('admin.grade.delete');
    });

    /* Student */
    Route::prefix('student')->group(function() {
        Route::get('/',[StudentController::class, 'index'])->name('admin.student');
        Route::get('/add',[StudentController::class, 'add'])->name('admin.student.add');
        Route::get('/view',[StudentController::class, 'view'])->name('admin.student.view');
    });

    /* Form */
    Route::prefix('form')->group(function() {
        Route::get('/',[FormController::class, 'index'])->name('admin.form');
        Route::get('/add',[FormController::class, 'add'])->name('admin.form.add');
        Route::post('/store', [FormController::class, 'store'])->name('admin.form.store');
        Route::get('/search', [FormController::class, 'search'])->name('admin.form.search');
        Route::get('/view/{id}', [FormController::class, 'view'])->name('admin.form.view');
        Route::get('/edit/{id}', [FormController::class, 'edit'])->name('admin.form.edit');
        Route::post('/update/{id}', [FormController::class, 'update'])->name('admin.form.update');
        Route::get('/delete/{id}', [FormController::class, 'delete'])->name('admin.form.delete');
    });


    Route::prefix('sport')->group(function() {
        Route::prefix('high')->group(function() {
            Route::get('/', [SportHighController::class, 'index'])->name('admin.sport.high');
            Route::get('/add', [SportHighController::class, 'add'])->name('admin.sport.high.add');
            Route::post('/store', [SportHighController::class, 'store'])->name('admin.sport.high.store');
            Route::get('/search', [SportHighController::class, 'search'])->name('admin.sport.high.search');
            Route::get('/view/{id}', [SportHighController::class, 'view'])->name('admin.sport.high.view');
            Route::get('/edit/{id}', [SportHighController::class, 'edit'])->name('admin.sport.high.edit');
            Route::post('/update/{id}', [SportHighController::class, 'update'])->name('admin.sport.high.update');
            Route::get('/delete/{id}', [SportHighController::class, 'delete'])->name('admin.sport.high.delete');
        });

        Route::prefix('primary')->group(function() {
            Route::get('/', [SportPrimaryController::class, 'index'])->name('admin.sport.primary');
            Route::get('/add', [SportPrimaryController::class, 'add'])->name('admin.sport.primary.add');
            Route::post('/store', [SportPrimaryController::class, 'store'])->name('admin.sport.primary.store');
            Route::get('/search', [SportPrimaryController::class, 'search'])->name('admin.sport.primary.search');
            Route::get('/view/{id}', [SportPrimaryController::class, 'view'])->name('admin.sport.primary.view');
            Route::get('/edit/{id}', [SportPrimaryController::class, 'edit'])->name('admin.sport.primary.edit');
            Route::post('/update/{id}', [SportPrimaryController::class, 'update'])->name('admin.sport.primary.update');
            Route::get('/delete/{id}', [SportPrimaryController::class, 'delete'])->name('admin.sport.primary.delete');
        });
        
    });


    Route::prefix('class')->group(function() {
        Route::prefix('high')->group(function() {
            Route::get('/', [ClassHighController::class, 'index'])->name('admin.class.high');
            Route::get('/add', [ClassHighController::class, 'add'])->name('admin.class.high.add');
            Route::post('/store', [ClassHighController::class, 'store'])->name('admin.class.high.store');
            Route::get('/search', [ClassHighController::class, 'search'])->name('admin.class.high.search');
            Route::get('/view/{id}', [ClassHighController::class, 'view'])->name('admin.class.high.view');
            Route::get('/edit/{id}', [ClassHighController::class, 'edit'])->name('admin.class.high.edit');
            Route::post('/update/{id}', [ClassHighController::class, 'update'])->name('admin.class.high.update');
            Route::get('/delete/{id}', [ClassHighController::class, 'delete'])->name('admin.sclass.high.delete');
        });

        Route::prefix('primary')->group(function() {
            Route::get('/', [ClassPrimaryController::class, 'index'])->name('admin.class.primary');
            Route::get('/add', [ClassPrimaryController::class, 'add'])->name('admin.class.primary.add');
            Route::post('/store', [ClassPrimaryController::class, 'store'])->name('admin.class.primary.store');
            Route::get('/search', [ClassPrimaryController::class, 'search'])->name('admin.class.primary.search');
            Route::get('/view/{id}', [ClassPrimaryController::class, 'view'])->name('admin.class.primary.view');
            Route::get('/edit/{id}', [ClassPrimaryController::class, 'edit'])->name('admin.class.primary.edit');
            Route::post('/update/{id}', [ClassPrimaryController::class, 'update'])->name('admin.class.primary.update');
            Route::get('/delete/{id}', [ClassPrimaryController::class, 'delete'])->name('admin.class.primary.delete');
        });
        
    });


    /* Subject */
    Route::prefix('subject')->group(function() {
        Route::prefix('high')->group(function() {
            Route::get('/', [SubjectHighController::class, 'index'])->name('admin.subject.high');
            Route::get('/add', [SubjectHighController::class, 'add'])->name('admin.subject.high.add');
            Route::post('/store', [SubjectHighController::class, 'store'])->name('admin.subject.high.store');
            Route::get('/search', [SubjectHighController::class, 'search'])->name('admin.subject.high.search');
            Route::get('/view/{id}', [SubjectHighController::class, 'view'])->name('admin.subject.high.view');
            Route::get('/edit/{id}', [SubjectHighController::class, 'edit'])->name('admin.subject.high.edit');
            Route::post('/update/{id}', [SubjectHighController::class, 'update'])->name('admin.subject.high.update');
            Route::get('/delete/{id}', [SubjectHighController::class, 'delete'])->name('admin.subject.high.delete');
        });

        Route::prefix('primary')->group(function() {
            Route::get('/', [SubjectPrimaryController::class, 'index'])->name('admin.subject.primary');
            Route::get('/add', [SubjectPrimaryController::class, 'add'])->name('admin.subject.primary.add');
            Route::post('/store', [SubjectPrimaryController::class, 'store'])->name('admin.subject.primary.store');
            Route::get('/search', [SubjectPrimaryController::class, 'search'])->name('admin.subject.primary.search');
            Route::get('/view/{id}', [SubjectPrimaryController::class, 'view'])->name('admin.subject.primary.view');
            Route::get('/edit/{id}', [SubjectPrimaryController::class, 'edit'])->name('admin.subject.primary.edit');
            Route::post('/update/{id}', [SubjectPrimaryController::class, 'update'])->name('admin.subject.primary.update');
            Route::get('/delete/{id}', [SubjectPrimaryController::class, 'delete'])->name('admin.subject.primary.delete');
        });
        
    });

    /* Subjects */
    Route::prefix('subject')->group(function() {
        Route::get('/',[SubjectController::class, 'index'])->name('admin.subject');
        Route::get('/add',[SubjectController::class, 'add'])->name('admin.subject.add');
    });

    /* Books */
    Route::prefix('book')->group(function() {
        Route::get('/',[BookController::class, 'index'])->name('admin.book');
        Route::get('/add',[BookController::class, 'add'])->name('admin.book.add');
    });

    /* Sport */
    Route::prefix('sport')->group(function() {
        Route::get('/',[SportController::class, 'index'])->name('admin.sport');
        Route::get('/add',[SportController::class, 'add'])->name('admin.sport.add');
    });

    /* Club */

    Route::prefix('club')->group(function() {
        Route::prefix('high')->group(function() {
            Route::get('/', [ClubHighController::class, 'index'])->name('admin.club.high');
            Route::get('/add', [ClubHighController::class, 'add'])->name('admin.club.high.add');
            Route::post('/store', [ClubHighController::class, 'store'])->name('admin.club.high.store');
            Route::get('/search', [ClubHighController::class, 'search'])->name('admin.club.high.search');
            Route::get('/view/{id}', [ClubHighController::class, 'view'])->name('admin.club.high.view');
            Route::get('/edit/{id}', [ClubHighController::class, 'edit'])->name('admin.club.high.edit');
            Route::post('/update/{id}', [ClubHighController::class, 'update'])->name('admin.club.high.update');
            Route::get('/delete/{id}', [ClubHighController::class, 'delete'])->name('admin.club.high.delete');
        });

        Route::prefix('primary')->group(function() {
            Route::get('/', [ClubPrimarycontroller::class, 'index'])->name('admin.club.primary');
            Route::get('/add', [ClubPrimarycontroller::class, 'add'])->name('admin.club.primary.add');
            Route::post('/store', [ClubPrimarycontroller::class, 'store'])->name('admin.club.primary.store');
            Route::get('/search', [ClubPrimarycontroller::class, 'search'])->name('admin.club.primary.search');
            Route::get('/view/{id}', [ClubPrimarycontroller::class, 'view'])->name('admin.club.primary.view');
            Route::get('/edit/{id}', [ClubPrimarycontroller::class, 'edit'])->name('admin.club.primary.edit');
            Route::post('/update/{id}', [ClubPrimarycontroller::class, 'update'])->name('admin.club.primary.update');
            Route::get('/delete/{id}', [ClubPrimaryController::class, 'delete'])->name('admin.club.primary.delete');
        });
        
    });

    /* Roles */
    Route::prefix('role')->group(function() {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role');
        Route::get('/add', [RoleController::class, 'add'])->name('admin.role.add');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/search', [RoleController::class, 'search'])->name('admin.role.search');
        Route::get('/view/{id}', [RoleController::class, 'view'])->name('admin.role.view');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
    });

    /* User Tyoe */
    Route::prefix('usertype')->group(function() {
        Route::get('/',[UserTypeController::class, 'index'])->name('admin.usertype');
        Route::get('/add',[UserTypeController::class, 'add'])->name('admin.usertype.add');
        Route::post('/store', [UserTypeController::class, 'store'])->name('admin.usertype.store');
        Route::get('/search', [UserTypeController::class, 'search'])->name('admin.usertype.search');
        Route::get('/view/{id}', [UserTypeController::class, 'view'])->name('admin.usertype.view');
        Route::get('/edit/{id}', [UserTypeController::class, 'edit'])->name('admin.usertype.edit');
        Route::post('/update/{id}', [UserTypeController::class, 'update'])->name('admin.usertype.update');
        Route::get('/delete/{id}', [UserTypeController::class, 'delete'])->name('admin.usertype.delete');
    });

    /* Teacher */
    Route::prefix('teacher')->group(function() {
        Route::get('/',[TeacherController::class, 'index'])->name('admin.teacher');
        Route::get('/add',[TeacherController::class, 'add'])->name('admin.teacher.add');
    });

    /* Staff */
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
