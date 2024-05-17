<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');




Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group([ 'middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
    
    Route::prefix('/employee')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employee');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::put('{id}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::get('/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::get('{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    });

    Route::prefix('/option')->group(function () {
        Route::get('/', [OptionController::class, 'index'])->name('option');
        Route::get('/create', [OptionController::class, 'create'])->name('option.create');
        Route::post('/store', [OptionController::class, 'store'])->name('option.store');
        Route::put('{id}', [OptionController::class, 'update'])->name('option.update');
        Route::get('/show/{id}', [OptionController::class, 'show'])->name('option.show');
        Route::get('/edit/{id}', [OptionController::class, 'edit'])->name('option.edit');
        Route::get('{id}', [OptionController::class, 'destroy'])->name('option.destroy');
    });

    Route::prefix('/company')->group(function () {
        Route::get('/index', [CompanyController::class, 'index'])->name('company');
        Route::get('/create', [CompanyController::class, 'create'])->name('company.create');
        Route::post('/store', [CompanyController::class, 'store'])->name('company.store');
        Route::put('{id}', [CompanyController::class, 'update'])->name('company.update');
        Route::get('/show/{id}', [CompanyController::class, 'show'])->name('company.show');
        Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::get('{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
    });

    Route::prefix('/incident')->group(function () {
        Route::get('/index', [IncidentController::class, 'index'])->name('incident');
        Route::get('/create', [IncidentController::class, 'create'])->name('incident.create');
        Route::post('/store', [IncidentController::class, 'store'])->name('incident.store');
        Route::put('{id}', [IncidentController::class, 'update'])->name('incident.update');
        Route::get('/show/{id}', [IncidentController::class, 'show'])->name('incident.show');
        Route::get('/edit/{id}', [IncidentController::class, 'edit'])->name('incident.edit');
        Route::get('{id}', [IncidentController::class, 'destroy'])->name('incident.destroy');
    });


    Route::prefix('/user')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('user');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::put('{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::get('{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('/role')->group(function () {
        Route::get('/index', [RoleController::class, 'index'])->name('role');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::put('{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/show/{id}', [RoleController::class, 'show'])->name('role.show');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::get('{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    });
    Route::get('/cities/{country_id}', [HelperController::class, 'getCities'])->name('country-cities');
});

