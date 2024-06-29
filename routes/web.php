<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\Auth\MyWelcomeController;
use App\Http\Controllers\Business\DashboardController as BusinessDashboardController;
use App\Http\Controllers\Business\PaymentController as BusinessPaymentController;
use App\Http\Controllers\Business\SettingController;
use App\Http\Controllers\Business\SubscriptionController as BusinessSubscriptionController;
use App\Http\Middleware\HasBusiness;
use App\Http\Middleware\Manager;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {

    if (auth()->user()->level == 'admin') {
        return redirect(route('saasDashboard'));
    }

    if (auth()->user()->level != 'admin') {
        return redirect(route('business.dashboard'));
    }

    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [MyWelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [MyWelcomeController::class, 'savePassword']);
});

Route::middleware(['auth', Admin::class])->prefix('saas')->group(function () {
    Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::resource('cities', CityController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('logs', LogController::class);
    Route::resource('businesses', BusinessController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('saasDashboard');
});

Route::middleware(['auth', HasBusiness::class])->prefix('business')->name('business.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('settings', SettingController::class)->middleware(Manager::class);
    Route::resource('subscriptions', BusinessSubscriptionController::class)->middleware(Manager::class);
    Route::resource('payments', BusinessPaymentController::class)->middleware(Manager::class);
    Route::get('dashboard', [BusinessDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
