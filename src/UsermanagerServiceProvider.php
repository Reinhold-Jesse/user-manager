<?php

namespace Reinholdjesse\Usermanager;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Reinholdjesse\Usermanager\Livewire\User\Edit;
use Reinholdjesse\Usermanager\Livewire\User\Index;

class UsermanagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Livewire::component('user.index', Index::class);
        Livewire::component('user.edit', Edit::class);

        Route::group(['middleware' => ['web']], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'usermanager');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../src/Controllers/UserController.php' => app_path('Http/Controllers/UserController.php'),
            __DIR__ . '/../src/Livewire/User/Edit.php' => app_path('Http/Livewire/User/Edit.php'),
            __DIR__ . '/../src/Livewire/User/Index.php' => app_path('Http/Livewire/User/Index.php'),
            __DIR__ . '/../resources/views/user/index.blade.php' => resource_path('views/user/index.blade.php'),
            __DIR__ . '/../resources/views/livewire/user/edit.blade.php' => resource_path('views/livewire/user/edit.blade.php'),
            __DIR__ . '/../resources/views/livewire/user/index.blade.php' => resource_path('views/livewire/user/index.blade.php')], 'usermanager');
    }
}
