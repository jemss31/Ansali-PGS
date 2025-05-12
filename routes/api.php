<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HaircutController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AppointmentController;


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

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function(){

    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

    Route::get('/get-students', [StudentController::class, 'getStudents']);
    Route::post('/add-student', [StudentController::class, 'addStudent']);
    Route::put('/edit-student/{id}', [StudentController::class, 'editStudent']);
    Route::delete('/delete-student/{id}', [StudentController::class, 'deleteStudent']);
    
    Route::get('/get-customers', [CustomerController::class, 'index']);
    Route::get('/get-customers/{id}', [CustomerController::class, 'show']);
    Route::post('/add-customer', [CustomerController::class, 'store']);
    Route::put('/edit-customer/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

    Route::get('/get-haircuts', [HaircutController::class, 'index']);
    Route::get('/add-haircuts/{id}', [HaircutController::class, 'show']);
    Route::post('/add-haircuts', [HaircutController::class, 'store']);
    Route::put('/edit-haircuts/{id}', [HaircutController::class, 'update']);
    Route::delete('/delete-haircuts/{id}', [HaircutController::class, 'destroy']);

    Route::get('/get-pets', [PetController::class, 'index']);
    Route::get('/get-pets/{id}', [PetController::class, 'show']);
    Route::post('/add-pets', [PetController::class, 'store']);
    Route::put('/edit-pets/{id}', [PetController::class, 'update']);
    Route::delete('/delete-de pets/{id}', [PetController::class, 'destroy']);

    Route::get('/get-roles', [RoleController::class, 'index']);
    Route::get('/get-roles/{id}', [RoleController::class, 'show']);
    Route::post('/add-role', [RoleController::class, 'store']);
    Route::put('/edit-role/{id}', [RoleController::class, 'update']);
    Route::delete('/delete-role/{id}', [RoleController::class, 'destroy']);
    
    Route::get('/get-appointment', [AppointmentController::class, 'index']);
    Route::get('/get-appointment/{id}', [AppointmentController::class, 'show']);
    Route::post('/add-appointment', [AppointmentController::class, 'store']);
    Route::put('/edit-appointment/{id}', [AppointmentController::class, 'update']);
    Route::delete('/delete-appointment/{id}', [AppointmentController::class, 'destroy']);

    Route::post('/logout', [AuthenticationController::class, 'logout']);
});