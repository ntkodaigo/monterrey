@extends('layout')
    
@section('content')
   
   <h1>Editar Subcategoria de Producto</h1>
   <div class="row">
       <form method="POST" action="/subcategoriaproductos/{{ $subcategoriaproducto->idsubcategoriaproducto }}" >

       {{method_field ('PATCH')}}
           
        <div class="form-group">
            <input type="text" name="nombresubcategoriaproducto" value="{{ $subcategoriaproducto -> nombresubcategoriaproducto}}" class="form-control"> </input>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Actualizar Subcategoria de Producto</button>

        </div>
        {{csrf_field()}}
       </form>
     </div>

@endsection