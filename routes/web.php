<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [PageController::class, "index"])->name("users.index");
Route::get("/users/show/{id}", [PageController::class, "show"])->name("users.show");
Route::get("/users/create", [PageController::class, "create"])->name("users.create");
Route::post("/users/create", [PageController::class, "store"])->name("users.create");
Route::get("/users/edit/{id}", [PageController::class, "edit"])->name("users.edit");
Route::put("/users/edit/{id}", [PageController::class, "update"])->name("users.edit");
Route::delete("/users/delete/{id}", [PageController::class, "destroy"])->name("users.destroy");
