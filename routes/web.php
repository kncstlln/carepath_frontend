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
use App\Http\Controllers\Admin\AdminUpcomingVaccination;

use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserTCLController;
use App\Http\Controllers\User\UserVaccineHistoryController;
use App\Http\Controllers\User\UserUpcomingVaccination;

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
Route::delete('/history/delete/{id}', [AdminVaccineHistoryController::class, 'delete'])->name('admin.history.delete');

Route::get('/upcoming-vaccinations', [AdminUpcomingVaccination::class, 'index'])->name('admin.upcoming');
Route::get('/missed-vaccinations', [AdminUpcomingVaccination::class, 'missedVaccinations'])->name('admin.missed');
});

// Routes accessible only by user_type 1 (regular user)
Route::middleware(['check.user_type:1'])->prefix('user')->group(function () {
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/infants', [UserTCLController::class, 'index'])->name('user.infants.index');
Route::get('/infants/add', [UserTCLController::class, 'add'])->name('user.infants.add');
Route::post('/infants', [UserTCLController::class, 'store'])->name('user.infants.store');
Route::delete('/infants/delete{id}', [UserTCLController::class, 'delete'])->name('user.infants.delete');
Route::get('/infants/edit/{id}', [UserTCLController::class, 'edit'])->name('user.infants.edit');
Route::put('/infants/update{id}', [UserTCLController::class, 'update'])->name('user.infants.update');
Route::get('/infants/{id}', [UserTCLController::class, 'view'])->name('user.infants.view');

Route::get('/history', [UserVaccineHistoryController::class, 'index'])->name('user.history.index');
Route::get('/history/add/{id}', [UserVaccineHistoryController::class, 'add'])->name('user.history.add');
Route::post('/history', [UserVaccineHistoryController::class, 'store'])->name('user.history.store');
Route::delete('/history/delete/{id}', [UserVaccineHistoryController::class, 'delete'])->name('user.history.delete');
Route::get('/upcoming-vaccinations', [UserUpcomingVaccination::class, 'index'])->name('user.upcoming');
Route::get('/missed-vaccinations', [UserUpcomingVaccination::class, 'missedVaccinations'])->name('user.missed');
});






