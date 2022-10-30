<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\BookmarksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'show']);
Route::get('/users/{email}', [UserController::class, 'find']);
Route::delete('logout', [UserController::class, 'logout']);

Route::get('/tools', [ToolsController::class, 'show']);
Route::post('/storetools', [ToolsController::class, 'store']);
Route::delete('/tools/delete/{id}', [ToolsController::class, 'destroy']);

Route::post('/bookmarks/{toolId}', [BookmarksController::class, 'store']);

// Route::middleware(['auth:sanctum'])->group(function() {
//     Route::get('/tools', [ToolsController::class, 'show']);
//     Route::post('/storetools', [ToolsController::class, 'store']);
//     Route::delete('/tools/delete/{id}', [ToolsController::class, 'destroy']);

//     Route::post('/bookmarks/{toolId}', [BookmarksController::class, 'store']);
// });