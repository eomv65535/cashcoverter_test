<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperacionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use App\Models\Loan;

Route::get('/', function () {
    if (Session::has('token'))
        return redirect()->intended('home');
    return Inertia::render('Welcome');
});

Route::get('/home', function () {
    if (Session::has('token'))
        return redirect()->intended('home');
    return Inertia::render('Login');
})->name('dashboard');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('checkToken')->group(function () {


    Route::get('/home', function () {
        return Inertia::render('Dashboard', ["esadm" => Session::get('esadm')]);
    })->name('dashboard');

    Route::get('/loan', function () {
        $loans = Loan::paginate(10);
        return Inertia::render('Prestamos', ['loans' => $loans, "esadm" => Session::get('esadm')]);
    })->name('prestamos');

    Route::get('/loan/{num?}/operations', [OperacionController::class, 'index'])->name('operations.index');
    Route::post('/loan/{num?}/operations', [OperacionController::class, 'store'])->name('operations.store');

    Route::get('/users/list/{page?}', [AuthController::class, 'listausuarios'])->name('usuarios');
});
