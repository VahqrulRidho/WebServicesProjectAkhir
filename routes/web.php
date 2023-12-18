<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// routing modul
Route::get('modul/{filename}', function ($filename) {
    $path = storage_path('app/modul/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return response($file)->header('Content-Type', $type);
})->name('show-modul');



// Route::post('/login', [LoginController::class, 'login'])->name('login');
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update-password');



    // Route Master Data User
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::delete('user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Route Master Data Student
    Route::get('student', [StudentController::class, 'index'])->name('student.index');
    Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
    Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
    Route::patch('student/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::post('student/store', [StudentController::class, 'store'])->name('student.store');
    Route::delete('student/destroy/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

    // Route master data chapter
    Route::get('chapter', [ChapterController::class, 'index'])->name('chapter.index');
    Route::get('chapter/create', [ChapterController::class, 'create'])->name('chapter.create');
    Route::get('chapter/edit/{id}', [ChapterController::class, 'edit'])->name('chapter.edit');
    Route::patch('chapter/{id}', [ChapterController::class, 'update'])->name('chapter.update');
    Route::post('chapter/store', [ChapterController::class, 'store'])->name('chapter.store');
    Route::delete('chapter/destroy/{id}', [ChapterController::class, 'destroy'])->name('chapter.destroy');

    // Route master data module
    Route::get('module', [ModuleController::class, 'index'])->name('module.index');
    Route::get('module/create', [ModuleController::class, 'create'])->name('module.create');
    Route::get('module/edit/{id}', [ModuleController::class, 'edit'])->name('module.edit');
    Route::get('module/show/{id}', [ModuleController::class, 'show'])->name('module.show');
    Route::patch('module/{id}', [ModuleController::class, 'update'])->name('module.update');
    Route::post('module/store', [ModuleController::class, 'store'])->name('module.store');
    Route::delete('module/destroy/{id}', [ModuleController::class, 'destroy'])->name('module.destroy');

    // Route master data informasi
    Route::get('informasi', [InformationController::class, 'index'])->name('informasi.index');
    Route::get('informasi/create', [InformationController::class, 'create'])->name('informasi.create');
    Route::get('informasi/edit/{id}', [InformationController::class, 'edit'])->name('informasi.edit');
    Route::patch('informasi/{id}', [InformationController::class, 'update'])->name('informasi.update');
    Route::post('informasi/store', [InformationController::class, 'store'])->name('informasi.store');
    Route::delete('informasi/destroy/{id}', [InformationController::class, 'destroy'])->name('informasi.destroy');
});
