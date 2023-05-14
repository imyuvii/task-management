<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TaskApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function (){
    return 'Welcome to Task Management API';
});
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::group(['prefix' => '', 'as' => 'api.', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user');
    // Task
    Route::get('/tasks', [TaskApiController::class, 'index'])->name('tasks');
    Route::get('/tasks2', [TaskApiController::class, 'index'])->name('tasks2');
    Route::post('task/create', [TaskApiController::class, 'create'])->name('task.create');

    // Note
    Route::post('notes/media', 'NoteApiController@storeMedia')->name('notes.storeMedia');
    Route::resource('notes', 'NoteApiController');
});


