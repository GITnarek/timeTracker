<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')
    ->prefix('profile')
    ->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::middleware('auth')
    ->prefix('projects')
    ->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/{project_id}', [ProjectController::class, 'show'])->name('projects.show');
        Route::get('/{project_id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::patch('/{project_id}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/{project_id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
        Route::get('/statuses', [ProjectController::class, 'getStatuses'])->name('projects.statuses');

        Route::get('/{project_id}/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::post('/{project_id}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/{project_id}/tasks/', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/{project_id}/{task_id}', [TaskController::class, 'show'])->name('tasks.show');
        Route::get('/{project_id}/{task_id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::patch('/{project_id}/{task_id}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/{project_id}/{task_id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

        Route::get('/timer/active', [TimerController::class, 'running']);
        Route::post('/{id}/timer/stop', [TimerController::class, 'stopRunning']);
        Route::post('/{id}/timer', [TimerController::class, 'store']);
});

//Route::middleware('auth')
//    ->prefix('projects')
//    ->group(function () {
//    Route::resource('/', ProjectController::class)->names([
//        'index' => 'projects.index',
//        'create' => 'projects.create',
//        'store' => 'projects.store',
//        'show' => 'projects.show',
//        'edit' => 'projects.edit',
//        'update' => 'projects.update',
//        'destroy' => 'projects.destroy',
//    ]);
//
//    Route::resource('/{project_id}/task', TaskController::class)->names([
//        'index' => 'task.index',
//        'create' => 'task.create',
//        'store' => 'task.store',
//        'show' => 'task.show',
//        'edit' => 'task.edit',
//        'update' => 'task.update',
//        'destroy' => 'task.destroy',
//    ])->except(['index', 'create', 'store']);
//
//    Route::get('/timer/active', [TimerController::class, 'running']);
//    Route::post('/{id}/timer/stop', [TimerController::class, 'stopRunning']);
//    Route::post('/{id}/timer', [TimerController::class, 'store']);
//});

require __DIR__.'/auth.php';
