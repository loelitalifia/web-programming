<?php

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

// Route::get('/', function () {
//     return view('list_video');
// });

Route::get('/',[App\Http\Controllers\Video::class,'fetch']);
Route::get('/list_video',[App\Http\Controllers\Video::class,'fetch']);
Route::post('/insert_video',[App\Http\Controllers\Video::class,'insert'])->name('insert.file');
Route::patch('/video/update/{id}', [App\Http\Controllers\Video::class,'update'])->name('video.update');
Route::get('/video/edit/{id}', [App\Http\Controllers\Video::class,'edit'])->name('video.edit');
Route::get('/video/add', [App\Http\Controllers\Video::class,'add'])->name('video.add');
Route::delete('/video/delete/{id}', [App\Http\Controllers\Video::class,'destroy'])->name('video.destroy');
