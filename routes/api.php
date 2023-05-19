<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CoursesController;
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
    
    Route::get("/users", [UserController::class, "getUsers"]);
    Route::get("/users/{id}", [UserController::class, "getUserById"]);
    Route::put("/users/{id}", [UserController::class, "updateUser"]);
    Route::delete("/users/{id}", [UserController::class, "deleteUser"]);
    
    Route::get("/courses", [CoursesController::class, "getCourses"]);
    Route::post("/courses", [CoursesController::class, "insertCourses"]);
    Route::get("/courses/{id}", [CoursesController::class, "getCourseById"]);
    Route::put("/courses/{id}", [CoursesController::class, "updateCourse"]);
    Route::delete("/courses/{id}", [CoursesController::class, "deleteCourse"]);
    Route::get("/courses_student/{id}", [CoursesController::class, "getCourseStudents"]);       

    Route::get("/students", [StudentsController::class, "getStudents"]);
    Route::post("/students", [StudentsController::class, "insertStudents"]);
    Route::get("/students/{id}", [StudentsController::class, "getStudentById"]);
    Route::put("/students/{id}", [StudentsController::class, "updateStudent"]);
    Route::delete("/students/{id}", [StudentsController::class, "deleteStudent"]);
    Route::get("/student_courses/{id}", [StudentsController::class, "getStudentCourses"]);

});