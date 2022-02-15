<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all(); //ORM

    $users = DB::table('users')->get();
    return view('dashboard',compact('users'));
})->name('dashboard');

Route::get('/category/all', [CategoryController::class,'AllCat'])->name('all.category');

Route::post('/category/add', [CategoryController::class,'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class,'Edit']);
Route::post('/category/update/{id}', [CategoryController::class,'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class,'SoftDelete']);
Route::get('category/restore/{id}', [CategoryController::class,'Restore']);
Route::get('pdelete/category/{id}', [CategoryController::class,'PDelete']);


//FOR BRAND ROUTE
Route::get('/brand/all', [BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class,'AddBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class,'EditBrand']);
Route::post('/brand/update/{id}', [BrandController::class,'UpdateBrand']);
Route::get('/brand/delete/{id}', [BrandController::class,'DeleteBrand']);