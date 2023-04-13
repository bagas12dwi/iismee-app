<?php

use App\Http\Controllers\AdminLecturerController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminSubjectController;
use App\Http\Controllers\AdminSupervisorController;
use App\Http\Controllers\AssesmentAspectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->middleware('guest');

//admin Controller 
Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {
    Route::get('dashboard-admin', [DashboardAdminController::class, 'index']);
    Route::get('manage-mahasiswa', [AdminStudentController::class, 'index']);
    Route::get('add-mahasiswa', [AdminStudentController::class, 'indexTambahMahasiswa']);
    Route::resource('manage-mahasiswa', AdminStudentController::class);
    Route::resource('manage-dosen', AdminLecturerController::class);
    Route::resource('manage-matakuliah', AdminSubjectController::class);
    Route::resource('manage-dpl', AdminSupervisorController::class);
    Route::resource('aspek-penilaian', AssesmentAspectController::class);
    Route::resource('manage-magang', InternshipController::class);
});

//auth Controller
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
