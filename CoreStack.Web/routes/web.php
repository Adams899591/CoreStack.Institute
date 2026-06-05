<?php

use App\Livewire\Admin\AdminDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', AdminDashboard::class)->name("admin.dashboard");