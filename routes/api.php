<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/home', function(){
//     return view('home');
// });

Route::get('/register', function(){
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);


Route::get('/login', function(){
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']);


Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('/tasks', TaskController::class);

Route::get('/allTasks/{uname}', [TaskController::class, 'retriveAll']);

Route::get('/update_task', function(){
    return view('update_task');
});

?>