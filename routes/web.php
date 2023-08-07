<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

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


Route::get('/', [WebController::class,'main']);
Route::get('/dashboard', [WebController::class,'index']);
Route::get('/barangay', [WebController::class,'barangay']);
Route::get('/addBarangay', [WebController::class,'addBarangay']);
Route::get('/addHistory', [WebController::class,'addHistory']);
Route::get('/editHistory', [WebController::class,'editHistory']);
Route::get('/history', [WebController::class,'history']);
Route::get('/viewHistory', [WebController::class,'viewHistory']);
Route::get('/addInfant', [WebController::class,'addInfant']);
Route::get('/editInfant', [WebController::class,'editInfant']);
Route::get('/infant', [WebController::class,'infant']);
Route::get('/viewInfant', [WebController::class,'viewInfant']);
Route::get('/addUser', [WebController::class,'addUser']);
Route::get('/editUser', [WebController::class,'editUser']);
Route::get('/user', [WebController::class,'user']);
Route::get('/addVaccine', [WebController::class,'addVaccine']);
Route::get('/editVaccine', [WebController::class,'editVaccine']);
Route::get('/vaccine', [WebController::class,'vaccine']);
Route::get('/viewVaccine', [WebController::class,'viewVaccine']);
Route::get('/upcoming', [WebController::class,'upcoming']);
Route::get('/missed', [WebController::class,'missed']);


