# Laravel Cheatsheet: General Features

## Table of Contents
1. [Routing](#routing)
2. [Middleware](#middleware)
3. [Controllers](#controllers)
4. [Requests & Responses](#requests--responses)
5. [Blade Templating](#blade-templating)
6. [Validation](#validation)
7. [Authentication](#authentication)
8. [Task Scheduling](#task-scheduling)
9. [Queues](#queues)
10. [Filesystem](#filesystem)
11. [Helpers](#helpers)

---

## Routing
### Basic Route
```php
Route::get('/welcome', function () {
    return view('welcome');
});
```

### Route with Parameters
```php
Route::get('/user/{id}', function ($id) {
    return 'User ' . $id;
});
```

### Named Routes
```php
Route::get('/profile', [UserController::class, 'show'])->name('profile');
// Usage
$url = route('profile');
```

### Route Groups
```php
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
    });
});
```

### API Routes
```php
Route::middleware('api')->group(function () {
    Route::get('/data', [ApiController::class, 'index']);
});
```

---

## Middleware
### Applying Middleware
```php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});
```

### Creating Middleware
```bash
php artisan make:middleware EnsureTokenIsValid
```
```php
// In the middleware
public function handle($request, Closure $next) {
    if ($request->token !== 'valid-token') {
        return redirect('home');
    }
    return $next($request);
}
```

---

## Controllers
### Basic Controller
```bash
php artisan make:controller UserController
```
```php
class UserController extends Controller {
    public function index() {
        return view('users.index');
    }
}
```

### Resource Controller
```bash
php artisan make:controller PostController --resource
```
```php
// Register in routes
Route::resource('posts', PostController::class);
```

### Invokable Controller
```bash
php artisan make:controller CheckoutController --invokable
```
```php
class CheckoutController extends Controller {
    public function __invoke() {
        return view('checkout');
    }
}
```

---

## Requests & Responses
### Accessing Request Data
```php
use Illuminate\Http\Request;

Route::post('/submit', function (Request $request) {
    $name = $request->input('name');
});
```

### JSON Response
```php
return response()->json(['message' => 'Success']);
```

### Redirecting
```php
return redirect('/home');
return back();
```

---

## Blade Templating
### Blade Syntax
```php
// Displaying Data
{{ $name }}
{!! $html !!}

// If Statement
@if ($user)
    Welcome, {{ $user->name }}!
@else
    Welcome, Guest!
@endif

// Loop
@foreach ($users as $user)
    <p>{{ $user->name }}</p>
@endforeach
```

### Components
```php
// Create a component
php artisan make:component Alert

// Usage
<x-alert type="success" message="Operation successful!" />
```

---

## Validation
### Validating Requests
```php
$request->validate([
    'title' => 'required|max:255',
    'email' => 'required|email',
]);
```

### Custom Validation Rules
```bash
php artisan make:rule Uppercase
```
```php
class Uppercase implements Rule {
    public function passes($attribute, $value) {
        return strtoupper($value) === $value;
    }

    public function message() {
        return 'The :attribute must be uppercase.';
    }
}
```

---

## Authentication
### Breeze Starter Kit
```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```

### Protecting Routes
```php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});
```

---

## Task Scheduling
### Defining a Scheduled Task
```php
$schedule->call(function () {
    Log::info('Scheduled Task Executed');
})->daily();
```

### Custom Artisan Command
```bash
php artisan make:command SendEmails
```
```php
protected function schedule(Schedule $schedule) {
    $schedule->command('emails:send')->hourly();
}
```

---

## Queues
### Basic Queue Usage
```php
// Dispatch Job
SendEmail::dispatch($user);

// Define Job
php artisan make:job SendEmail
```

### Queue Workers
```bash
php artisan queue:work
```

---

## Filesystem
### Storing Files
```php
$path = $request->file('avatar')->store('avatars');
```

### Retrieving Files
```php
$url = Storage::url('file.jpg');
$content = Storage::get('file.jpg');
```

---

## Helpers
### Common Helpers
```php
// URL Generation
$url = url('/home');

// Environment Variable
$env = env('APP_ENV');

// Debugging
logger('Something happened');
dd($data);
```

### String Helpers
```php
use Illuminate\Support\Str;

$slug = Str::slug('Laravel Cheatsheet');
$random = Str::random(10);
