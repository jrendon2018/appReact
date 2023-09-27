<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Api crud productos
// GET http://127.0.0.1:8000/api/productos
/*Route::get("/producto", function(){
   // return ["ropa ", "muebles" ];
    $Productos = DB::select("select * from productos" );
    return $Productos;
});*/

Route::get("/producto", [ProductoController::class, "listar"]);
Route::post("/producto", [ProductoController::class, "guardar"]);
Route::get("/producto/{id}", [ProductoController::class, "mostrar"]);
Route::put("/producto/{id}" ,[ProductoController::class, "modificar"]);
Route::delete("/producto" ,[ProductoController::class, "eliminar"]);

Route::prefix("v1/auth")->group(function(){

    Route::post("/login",[AuthController::class, "funIngresar"]);
    Route::post("/register",[AuthController::class, "funlRegistro"]);

    Route::middleware(['auth:sanctum'])->group(function(){
        Route::get("/profile",[AuthController::class, "funlPerfil"]);
        Route::post("/logout",[AuthController::class, "funlSalir"]);

    });   
});
    //auth
