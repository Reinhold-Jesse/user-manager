<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('dashboard/user')->name('package.users.manager.')->group(function () {
    Route::get('/', [\Heco\Usermanager\Controllers\UserController::class, 'index'])->name('user.index');
    //sondern funktionen
    Route::get('user/check/photo', [\Heco\Usermanager\Controllers\UserController::class, 'userImagesCheck']);
    Route::get('user/check/photo/folder', [\Heco\Usermanager\Controllers\UserController::class, 'imageFolderCheck']);
});
