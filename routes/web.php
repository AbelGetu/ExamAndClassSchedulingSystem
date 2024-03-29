<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\ClassYearController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\ExamTimetableController;
use App\Http\Controllers\DepartmentHeadController;
use App\Http\Controllers\ExamAllocationController;
use App\Http\Controllers\ClassAllocationController;
use App\Http\Controllers\AcademicCalendarController;
use App\Http\Controllers\SectionAllocationController;
use App\Http\Controllers\TeacherAllocationController;
use App\Http\Controllers\ClassSectionAllocationController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('institutes', InstituteController::class);
Route::resource('colleges', CollegeController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('department_heads', DepartmentHeadController::class);
Route::resource('academic_calendars', AcademicCalendarController::class);
Route::resource('buildings', BuildingController::class);
Route::resource('rooms', RoomController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('semesters', SemesterController::class);
// Route::resource('students', StudentController::class);
// Route::resource('teachers', TeacherController::class);
Route::resource('student_classes', StudentClassController::class);
Route::resource('periods', PeriodController::class);
Route::resource('class_years', ClassYearController::class);
// Route::resource('class_allocations', ClassAllocationController::class);
// Route::resource('teacher_allocations', TeacherAllocationController::class);
// Route::resource('exam_allocations', ExamAllocationController::class);
Route::resource('sections', SectionController::class);
Route::resource('class_section_allocations', ClassSectionAllocationController::class);
Route::resource('section_allocations', SectionAllocationController::class);
// Route::resource('exam_allocations', ExamAllocationController::class);
Route::resource('teacher_allocations', TeacherAllocationController::class);
Route::resource('days', DayController::class);
Route::resource('timetables', TimetableController::class);
Route::get('get_timetable', [TimetableController::class, 'getTimetables'])->name('get_timetable');
Route::resource('exam_timetables', ExamTimetableController::class);
Route::get('get_exam_timetable', [ExamTimetableController::class, 'getExamTimetables'])->name('get_exam_timetable');

Route::get('my_timetable', [TimetableController::class, 'myTimetable'])->name('my_timetable');