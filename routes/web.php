<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);
Route::get('/courses/{course_code}', [IndexController::class, 'courses']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'showAdminPanel'])->name('admin.panel');

    Route::get('/admin/course/{id}/users', [AdminController::class, 'showCourseUsers'])->name('course.users');
    Route::post('/admin/{course_id}/{user_id}/cancelsubscribe', [AdminController::class, 'cancelSubscribe']);

    Route::get('/course/add', [CourseController::class, 'showAddForm']);
    Route::post('/course/add', [CourseController::class, 'add'])->name('course.add');

    Route::post('/course/delete/{id}', [CourseController::class, 'delete'])->name('course.delete');

    Route::get('/course/edit/{id}', [CourseController::class, 'showEditForm'])->name('course.editForm');
    Route::post('/course/edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/course/{id}/subscribe', [CourseController::class, 'subscribe']);
    Route::get('/course/{id}/subscribecancel', [CourseController::class, 'cancelSubscribe']);
    Route::get('/user/courses', [CourseController::class, 'userCourses'])->name('user.courses');
});

Route::middleware('auth')->group(function () {
    Route::get('/course/{id}', [CourseController::class, 'show']);
});

require __DIR__.'/auth.php';
