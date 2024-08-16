<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;



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
Route::get('/category', [IndexController::class,'show_category']);
Route::get('/enter', [IndexController::class,'enter']);
Route::post('/enter', [IndexController::class,'login'])->name('login');

Route::get('/exit',[IndexController::class, 'exit']);


Route::get('/registration', [IndexController::class,'registration']);
Route::post('/registration',[IndexController::class, 'registration'])->name('registration');
Route::post('/reg',[IndexController::class, 'reg'])->name('reg');

Route::get('/category/{id}', [IndexController::class,'show_info_category']);


Route::get('/cabinet', [IndexController::class,'show_cabinet']);


Route::get('/add',[IndexController::class, 'add']);
Route::post('/addd',[IndexController::class, 'add_content'])->name('add_content');


Route::get('/change/{id}',[IndexController::class, 'change']);
Route::post('/change',[IndexController::class, 'change_content'])->name('change_content');



Route::get('/confirmation/{id}',[IndexController::class, 'confirmation']);
Route::post('/confirmation',[IndexController::class, 'confirmation_content'])->name('confirmation_content');

