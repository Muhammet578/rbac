<?php

use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([CheckPermission::class . ':create_user'])->group(function () {
    Route::get('/admin/user', function() {
        return 'Список пользователей';
    });
});