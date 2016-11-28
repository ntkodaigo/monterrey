@extends('layout')
    
@section('content')
   
   <h1>Editar Subcategoria de Servicios</h1>
   <div class="row">
       <form method="POST" action="/subcategoriaservicios/{{ $subcategoriaservicio->idsubcategoriaservicio }}" class="col-md-6">

       {{method_field ('PATCH')}}
           
        <div class="form-group">
            <input type="text" name="nombresubcategoriaservicio" value="{{ $subcategoriaservicio -> nombresubcategoriaservicio}}" class="form-control"> </input>
        </div>
        <div>
            <button type="submit" class="btn btn-info btn-lg">Actualizar Subcategoria de Servicios</button>

        </div>
        {{csrf_field()}}
       </form>
     </div>

@endsection