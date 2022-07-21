<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HospitalController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\MedicoPacienteController;
use App\Http\Controllers\Api\PacienteController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('/hospital', HospitalController::class)->middleware('auth:api');
Route::apiResource('/medico', MedicoController::class)->middleware('auth:api');
Route::apiResource('/paciente', PacienteController::class)->middleware('auth:api');
Route::apiResource('/medico-paciente', MedicoPacienteController::class)->middleware('auth:api');
