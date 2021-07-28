<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AuthController;

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

// Route::get('/', function () {
//     return view('login');
// });




Route::group(['middleware' => 'guest'], function(){
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
    Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister']);
});


Route::group(['middleware' => 'auth'], function(){
    Route::get('/',[PagesController::class, 'home'])->name('home');
    Route::get('/home',[PagesController::class, 'home']);
    Route::get('/customer',[PagesController::class, 'customer'])->name('customer');
    Route::post('/customer',[PagesController::class, 'customerPost']);
    Route::get('/staff',[PagesController::class, 'staff'])->name('staff');
    Route::get('/test', function () {return "Yay";});
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/feedback',[PagesController::class, 'feedback'])->name('feedback');
    Route::post('/feedback',[PagesController::class, 'feedback_send']);
    Route::get('/feedbacks',[PagesController::class, 'feedbacks'])->name('feedbacks');
    Route::get('/feedbacks/{id}',[PagesController::class, 'feedback_d']);
    Route::get('/message',[PagesController::class, 'message']);
    Route::get('/message/{id}',[PagesController::class, 'message_d']);
    Route::post('/message/{id}',[PagesController::class, 'message_send']);
    Route::get('/message_all',[PagesController::class, 'message_all']);
    
});
