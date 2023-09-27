<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listar(){
        $Productos = DB::select("select * from productos" );
        return $Productos;
    }

    public function guardar(Request  $request)
    {
        $nombre = $request->nombre;
        $precio= $request->precio;
        $stock = $request->stock;
        $imagen = $request->imagen;
        $descripcion = $request->descipcion;
        DB::insert('insert into productos(nombre, precio, stock,imagen,descripcion) values(?,?,?,?,?)',[ $nombre, $precio, $stock,$imagen,$descripcion]);
        return ["mensaje" => "producto registrado"];
    }

    public function mostrar($id){
        $producto = DB::table("productos")->find($id);
        return $producto;
    }
}
