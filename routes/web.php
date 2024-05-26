<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminC;

Route::get('/PageLogin', function () {
    return view('adminPage/adminLogin');
})->name('login');
Route::get('/PageReg', function () {
    return view('adminPage/adminRegister');
})->name('register');
Route::post('/adminLogin', [AdminC::class,'login'])->name('Alogin');
Route::post('/adminReg', [AdminC::class,'register'])->name('ARegister');
Route::post('/search',[AdminC::class,'Search'])->name("search");
Route::get('/', [AdminC::class,'Main'])->name('home');
Route::get('/FullPost/{id}',[AdminC::class,'FullPage'])->name('Page');
Route::post('/commenting/{id}', [AdminC::class,'Comment'])->name('Comment');
Route::middleware('auth')->group(function () {
    Route::get('/Dashboard', [AdminC::class,'dashboard'])->name('Dashboard');
    Route::get('/LogoutFunc', [AdminC::class,'logout'])->name('LogoutFunc');
    Route::post('/pubpost', [AdminC::class,'PublishPost'])->name('PublishPost');
    Route::post('/ANC', [AdminC::class,'AddNewCategory'])->name('NewCategory');
    Route::post('/Delete/{id}', [AdminC::class,'DeleteAccount'])->name('Delete');
});
