<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('dashboard/user')->name('package.users.manager.')->group(function () {
    Route::get('/', [\Reinholdjesse\Usermanager\Controllers\UserController::class, 'index'])->name('index');
    //sondern funktionen
    Route::get('user/check/photo', [\Reinholdjesse\Usermanager\Controllers\UserController::class, 'userImagesCheck']);
    Route::get('user/check/photo/folder', [\Reinholdjesse\Usermanager\Controllers\UserController::class, 'imageFolderCheck']);
});
