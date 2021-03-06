<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\Categoriaproducto;

class categoriaproductoController extends Controller
{
    public function index()
	{
		$categoriaproductos=Categoriaproducto::all();
        $init_route = config('constants.init_route');

      	return view('categoriaproductos.index', compact('categoriaproductos', 'init_route'));
      	

	}

	public function show(Categoriaproducto $categoriaproducto)
	{
		$init_route = config('constants.init_route');

		return view('categoriaproductos.details', compact('categoriaproducto', 'init_route'));
	}

	public function store(Request $request)
	{
		$categoriaproducto = new Categoriaproducto ($request-> all());
    	
        $categoriaproducto->save();

    	return redirect('/categoriaproductos');

	}

	public function edit( Categoriaproducto $categoriaproducto)
	{
		return view('categoriaproductos.edit', compact('categoriaproducto'));


	}

	public function update(Request $request, Categoriaproducto $categoriaproducto)
	{
		$categoriaproducto -> update($request->all());
    	return back();

	}

	public function delete( Request $request, Categoriaproducto $categoriaproducto)
	{
		$categoriaproducto->delete();
		return response()->json(['success' => true]);

	}

	public function data()
	{
		return Datatables::of(Categoriaproducto::all())->addColumn('action', function ($categoriaproducto) {
            
            return '<a href="/categoriaproductos/'.$categoriaproducto->idcategoriaproducto.'/edit">
            <button class="btn btn-success btn-edit">Editar</button>
            </a>

            <button type="button" onclick="btnDeleteCategoriaProducto('.$categoriaproducto->idcategoriaproducto.')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>Delete</button>';
               
            })->make(true);
	}
}
