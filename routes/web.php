<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\UserController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminBarangayController;
use App\Http\Controllers\Admin\AdminVaccineController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminTCLController;
use App\Http\Controllers\Admin\AdminVaccineHistoryController;

use App\Http\Controllers\User\UserDashboardController;

use App\Http\Controllers\AuthController;


Route::get('/', [MainController::class, 'index']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes accessible only by user_type 0 (admin)
Route::middleware(['check.user_type:0'])->prefix('admin')->group(function () {
Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/barangays', [AdminBarangayController::class, 'index'])->name('admin.barangays.index');
Route::put('/barangays/{id}/update-status', [AdminBarangayController::class, 'updateStatus'])->name('admin.barangays.update-status');
Route::get('/barangays/add', [AdminBarangayController::class, 'create'])->name('admin.barangays.add');
Route::post('/barangays/add', [AdminBarangayController::class, 'store'])->name('admin.barangays.store');

Route::get('/vaccines', [AdminVaccineController::class, 'index'])->name('admin.vaccines.index');
Route::put('/vaccines/{id}/update-status', [AdminVaccineController::class, 'updateStatus'])->name('admin.vaccines.update-status');
Route::get('/vaccines/add', [AdminVaccineController::class, 'add'])->name('admin.vaccines.add');
Route::post('/vaccines/store', [AdminVaccineController::class, 'store'])->name('admin.vaccines.store');
Route::get('/vaccines/{id}/delete', [AdminVaccineController::class, 'delete'])->name('admin.vaccines.delete');
Route::get('/vaccines/{id}', [AdminVaccineController::class, 'view'])->name('admin.vaccines.view');
Route::get('/vaccines/edit/{id}', [AdminVaccineController::class, 'edit'])->name('admin.vaccines.edit');
Route::put('/vaccines/{id}', [AdminVaccineController::class, 'update'])->name('admin.vaccines.update');

Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::get('/users/add', [AdminUserController::class, 'add'])->name('admin.users.add');
Route::post('/users/register', [AdminUserController::class, 'register'])->name('admin.users.register');
Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
Route::put('/users/update/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
Route::delete('/users/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.users.delete');

Route::get('/infants', [AdminTCLController::class, 'index'])->name('admin.infants.index');
Route::get('/getFilteredInfants/{barangay_id}/{year?}', [AdminTCLController::class, 'getFilteredInfants']);
Route::get('/infants/add', [AdminTCLController::class, 'add'])->name('admin.infants.add');
Route::post('/infants', [AdminTCLController::class, 'store'])->name('admin.infants.store');
Route::delete('/infants/delete/{id}', [AdminTCLController::class, 'delete'])->name('admin.infants.delete');
Route::get('/infants/edit/{id}', [AdminTCLController::class, 'edit'])->name('admin.infants.edit');
Route::put('/infants/update/{id}', [AdminTCLController::class, 'update'])->name('admin.infants.update');
Route::get('/infants/{id}', [AdminTCLController::class, 'view'])->name('admin.infants.view');
Route::get('/infants/success', [AdminTCLController::class, 'success'])->name('admin.infants.success');


Route::get('/history', [AdminVaccineHistoryController::class, 'index'])->name('admin.history.index');
Route::get('/history/filtered-records/{barangay_id}/{year?}', [AdminVaccineHistoryController::class, 'getFilteredImmunizationRecords']);
Route::get('/history/add/{id}', [AdminVaccineHistoryController::class, 'add'])->name('admin.history.add');
Route::post('/history', [AdminVaccineHistoryController::class, 'store'])->name('admin.history.store');


});

// Routes accessible only by user_type 1 (regular user)
Route::middleware(['check.user_type:1'])->prefix('user')->group(function () {
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});



// Route::get('/', [AdminController::class,'main']);
// Route::get('/login', [AdminController::class,'login']);
// Route::get('/dashboard', [AdminController::class,'index']);
// Route::get('/barangay', [AdminController::class,'barangay']);
// Route::get('/addBarangay', [AdminController::class,'addBarangay']);
// Route::get('/addHistory', [AdminController::class,'addHistory']);
// Route::get('/editHistory', [AdminController::class,'editHistory']);
// Route::get('/history', [AdminController::class,'history']);
// Route::get('/viewHistory', [AdminController::class,'viewHistory']);
// Route::get('/addInfant', [AdminController::class,'addInfant']);
// Route::get('/editInfant', [AdminController::class,'editInfant']);
// Route::get('/infant', [AdminController::class,'infant']);
// Route::get('/viewInfant', [AdminController::class,'viewInfant']);
// Route::get('/addUser', [AdminController::class,'addUser']);
// Route::get('/editUser', [AdminController::class,'editUser']);
// Route::get('/userlist', [AdminController::class,'user']);
// Route::get('/addVaccine', [AdminController::class,'addVaccine']);
// Route::get('/editVaccine', [AdminController::class,'editVaccine']);
// Route::get('/vaccine', [AdminController::class,'vaccine']);
// Route::get('/viewVaccine', [AdminController::class,'viewVaccine']);
// Route::get('/upcoming', [AdminController::class,'upcoming']);
// Route::get('/missed', [AdminController::class,'missed']);


// Route::get('/user/dashboard', [UserController::class,'indexUser']);
// Route::get('/user/addHistory', [UserController::class,'addHistoryUser']);
// Route::get('/user/editHistory', [UserController::class,'editHistoryUser']);
// Route::get('/user/history', [UserController::class,'historyUser']);
// Route::get('/user/viewHistory', [UserController::class,'viewHistoryUser']);
// Route::get('/user/addInfant', [UserController::class,'addInfantUser']);
// Route::get('/user/editInfant', [UserController::class,'editInfantUser']);
// Route::get('/user/infant', [UserController::class,'infantUser']);
// Route::get('/user/viewInfant', [UserController::class,'viewInfantUser']);
// Route::get('/user/upcoming', [UserController::class,'upcomingUser']);
// Route::get('/user/missed', [UserController::class,'missedUser']);





