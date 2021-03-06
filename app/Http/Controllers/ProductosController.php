<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Producto;
use App\Subcategoriaproducto;
use App\Categoriaproducto;
use App\Articulo;
use App\Proveedor;
use App\Http\Requests;

class ProductosController extends Controller
{

	public function productosDataToSelect()
    {
        return Datatables::of(Producto::with('articulo')->get())->addColumn('action', function ($entity) {
            


            return '<button type="button" onclick="btnSelectProducto('.$entity->articulo->idarticulo.',\''.$entity->nombreproducto.'\')" class="btn btn-success btn-edit"><i class="glyphicon glyphicon-edit"></i>Seleccionar</button>';
               
            })->make(true);
    }

    public function index()
	{
		$productos=Producto::all();
        $init_route = config('constants.init_route');

        $subcategoriaproductos=Subcategoriaproducto::all();

        $categoriaproductos=Categoriaproducto::all();
        
      	return view('productos.index', compact('productos', 'categoriaproductos','subcategoriaproductos', 'init_route'));
	}

	public function fillNew()
	{
		$key = 'c';
		$productos=Producto::all();
        $init_route = config('constants.init_route');

        $subcategoriaproductos=Subcategoriaproducto::all();

        $categoriaproductos=Categoriaproducto::all();
        
      	return view('productos.crud', compact('productos', 'key', 'categoriaproductos','subcategoriaproductos', 'init_route'));
	}

	public function edit(Producto $producto)
	{
		$key = 'u';
        $init_route = config('constants.init_route');

        $subcategoriaproductos=Subcategoriaproducto::all();

        $categoriaproductos=Categoriaproducto::all();
        
      	return view('productos.crud', compact('producto', 'key', 'categoriaproductos','subcategoriaproductos', 'init_route'));
	}

	public function store(Request $request) 
	{
		$producto = new Producto ($request-> all());

		$articulo = new Articulo;
		$lastArticulo = Articulo::orderBy('idarticulo', 'desc')->first();
    	$newId = ($lastArticulo == null) ? 1 : $lastArticulo->idarticulo + 1;

    	$producto->idproducto=$newId;
    	$producto->myarticulo()->save($articulo);
    	$articulo->idarticulo = $newId;
    	$articulo->producto()->save($producto);
    	//$articulo->idarticulo = $newId;
    	//$articulo->save();
    	//$producto->idproducto = $newId;
        //$producto->save();

    	return redirect('/productos');

	}

	public function update(Request $request, Producto $producto)
	{
		$producto -> update($request->all());
    	return back();
	}

	public function delete( Request $request, Producto $producto)
	{
		$producto->delete();
		
		return response()->json(['success' => true]);

	}

	public function data()
	{
		return Datatables::of(Producto::all())->addColumn('action', function ($producto) {
            
            return '<a href="/productos/edit/'.$producto->idproducto.'">
            <button class="btn btn-success btn-edit"><i class="glyphicon glyphicon-edit"></i>Editar</button>
            </a>

            <button type="button" onclick="btnDeleteProducto('.$producto->idproducto.')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</button>';
               
            })->make(true);
	}

	public function dataCompras()
	{
		return Datatables::of(Producto::all())->addColumn('action', function ($producto) {
            
            return '<button type="button" onclick="PickProducto('.$producto->idproducto.')" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i>Seleccionar</button>';
               
            })->make(true);
	}

	public function dataProveedor(Proveedor $proveedor)
	{
		return Datatables::of($proveedor->productos)->addColumn('action', function ($producto) {
            
            return '<button type="button" onclick="btnDeleteProducto('.$producto->idproducto.')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>Eliminar</button>';
               
            })->make(true);
	}
}
