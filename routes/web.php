<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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



Route::get('/', [AdminController::class,'main']);
Route::get('/login', [AdminController::class,'login']);
Route::get('/dashboard', [AdminController::class,'index']);
Route::get('/barangay', [AdminController::class,'barangay']);
Route::get('/addBarangay', [AdminController::class,'addBarangay']);
Route::get('/addHistory', [AdminController::class,'addHistory']);
Route::get('/editHistory', [AdminController::class,'editHistory']);
Route::get('/history', [AdminController::class,'history']);
Route::get('/viewHistory', [AdminController::class,'viewHistory']);
Route::get('/addInfant', [AdminController::class,'addInfant']);
Route::get('/editInfant', [AdminController::class,'editInfant']);
Route::get('/infant', [AdminController::class,'infant']);
Route::get('/viewInfant', [AdminController::class,'viewInfant']);
Route::get('/addUser', [AdminController::class,'addUser']);
Route::get('/editUser', [AdminController::class,'editUser']);
Route::get('/userlist', [AdminController::class,'user']);
Route::get('/addVaccine', [AdminController::class,'addVaccine']);
Route::get('/editVaccine', [AdminController::class,'editVaccine']);
Route::get('/vaccine', [AdminController::class,'vaccine']);
Route::get('/viewVaccine', [AdminController::class,'viewVaccine']);
Route::get('/upcoming', [AdminController::class,'upcoming']);
Route::get('/missed', [AdminController::class,'missed']);


Route::get('/user/dashboard', [UserController::class,'indexUser']);
Route::get('/user/addHistory', [UserController::class,'addHistoryUser']);
Route::get('/user/editHistory', [UserController::class,'editHistoryUser']);
Route::get('/user/history', [UserController::class,'historyUser']);
Route::get('/user/viewHistory', [UserController::class,'viewHistoryUser']);
Route::get('/user/addInfant', [UserController::class,'addInfantUser']);
Route::get('/user/editInfant', [UserController::class,'editInfantUser']);
Route::get('/user/infant', [UserController::class,'infantUser']);
Route::get('/user/viewInfant', [UserController::class,'viewInfantUser']);
Route::get('/user/upcoming', [UserController::class,'upcomingUser']);
Route::get('/user/missed', [UserController::class,'missedUser']);



