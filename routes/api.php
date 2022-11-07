<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ApiAuthController;
use App\Http\Controllers\User\ApiUserController;
use App\Http\Controllers\Task1\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('Task/Q-1/{start}/{end}', [ProjectController::class, 'firstQues']);
Route::get('Task/Q-2/{input_string}', [ProjectController::class, 'secondQues']);
Route::post('Task/Q-3', [ProjectController::class, 'thirdQues']);
// Route::get('Task/Q-3/{num}', [ProjectController::class, 'thirdQues']);


Route::group(['middleware' => ['json.response']], function () {
    Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
    Route::post('/login',  [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/logout',  [ApiAuthController::class, 'logout'])-> name('logout.api');

    Route::get("/users", [ApiUserController::class, "allUser"]);
    Route::get("/users/show/{id}", [ApiUserController::class, "showUser"]);
    Route::post("/users/create", [ApiUserController::class, "createUser"]);
    Route::put("/users/update/{id}", [ApiUserController::class, "updateUser"]);
    Route::delete("/users/delete/{id}", [ApiUserController::class, "deleteUser"]);
});