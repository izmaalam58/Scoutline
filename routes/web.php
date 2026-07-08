<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LeadScanController;

Route::get('/', function () {
    return view('landing');
});

// --- REGISTRATION SYSTEM ---

Route::get('/signup', [MemberController::class, 'create']);
Route::post('/signup', [MemberController::class, 'store']);

// --- DASHBOARD (PROTECTED) ---

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// --- LOGIN & LOGOUT SYSTEM ---

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// --- LEAD SCAN SYSTEM ---
Route::post('/scan', [LeadScanController::class, 'scan'])->name('scan');