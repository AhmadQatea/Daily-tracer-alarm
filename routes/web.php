<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\viewContoller;
use App\Http\Controllers\alarmsController;

Route::get('/', [viewContoller::class , 'index']);
Route::get('/feature', [viewContoller::class , 'feature']);
Route::get('/pricing', [viewContoller::class , 'pricing']);
Route::get('/create', [viewContoller::class , 'create']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/alarms/create', [alarmsController::class, 'create'])->name('alarms.create');


// مسار تعديل المنبهات
Route::get('/alarms/{id}/edit', [alarmsController::class, 'edit'])->name('alarms.edit');

// مسار حذف المنبهات
Route::delete('/alarms/{id}', [alarmsController::class, 'destroy'])->name('alarms.destroy');

Route::put('/alarms/{id}', [alarmsController::class, 'update'])->name('alarms.update');
