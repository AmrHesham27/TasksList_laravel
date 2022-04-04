<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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

/** Index */
Route::get('/', [TaskController::class,'index'])
->middleware('checkUser');

/* only not logged in users can visit this routes */
Route::middleware(['notLoggedIn'])->group(function(){
    Route::resource('User' ,UserController::class)->except( ['edit' , 'update'] );
    Route::get('/login', [UserController::class,'loginPage']);
    Route::post('/loginAction', [UserController::class,'loginAction']);
});

/* only logged in */
Route::middleware(['checkUser'])->group(function(){
    Route::resource('Task',TaskController::class)->except('index');
    Route::resource('User',UserController::class)->only( ['edit' , 'update'] );
    Route::get('/logOut', [UserController::class,'logOut']);
    Route::post('/status', [TaskController::class,'taskDone']);
    // pagination
    Route::get('/{from}', function($from){
        $pagination = $from - 1;
        session()->put('pagination', $pagination);
        return redirect(url('/'));
    });
});

