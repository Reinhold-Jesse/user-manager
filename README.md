# User Managment Package

## Install

**File** -> config\app.php

```php
/*
* Package Service Providers...
*/
    Heco\Usermanager\UserManagerServiceProvider::class,
/*
* Application Service Providers...
*/
```

**File** -> composer.json

```json
"autoload": {
    "psr-4": {
        "Heco\\Usermanager\\": "packages/heco/usermanager/src/",
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/"
    }
},
```

## Add User Model

```php
use Lab404\Impersonate\Models\Impersonate;

// User class
use Impersonate;


```

## Start Route

```php
{{ route('package.users.managment.user.index'); }}
```

---

# In your App include

## Step 1 (#Publish files)

```bash
php artisan vendor:publish --tag=usermanager
```

## Step 2 (#Add your Routes after published)

**File** -> routes/web.php

```php
Route::get('dashboard/user',[\App\Http\Controllers\UserController::class,'index']);
```
