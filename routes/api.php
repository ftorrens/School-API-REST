<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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


Route::post("register", [UserController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);

Route::middleware('auth:sanctum')->group(function() {

    Route::post("logout", [AuthController::class, "logout"]);
    
    Route::apiResource("/users", UserController::class);
    Route::get("/users", [UserController::class, "getUsers"]);

    Route::get("/students", [StudentsController::class, "getStudents"]);
    Route::post("/students", [StudentsController::class, "saveStudent"]);
    Route::get("/students/{id}", [StudentsController::class, "getStudentById"]);
    Route::put("/students/{id}", [StudentsController::class, "updateStudent"]);
    Route::delete("/students/{id}", [StudentsController::class, "deleteStudent"]);
    Route::get("/student_courses/{id}", [StudentsController::class, "getStudentCourses"]);


});