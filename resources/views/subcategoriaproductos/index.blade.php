@extends('layout')
    
@section('content')

<center><h3>CATEGORIA PRODUCTOS</h3></center>
<a href="#">
<!-- <button type="button" class="btn btn-info btn-lg" id="add">Nuevo Categoria</button> -->
</a>
<h3>Inserte Subcategoria de Producto</h3>
    <form method="POST" action="/subcategoriaproductos/add" class="col-md-6">
        <div class="form-group">
            <input type="text" name="nombresubcategoriaproducto" class="form-control">
        </div>

        <div class="form-group dropdown">
            <select name="idcategoriaproducto" class="btn btn-info btn-lg dropdown-toggle">
                @foreach ($categoriaproductos as $categoriaproducto)
                <option value="{{ $categoriaproducto -> idcategoriaproducto }}">{{ $categoriaproducto-> nombrecategoriaproducto }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <button type="submit" class="btn btn-info btn-lg">Agregar Subcategoria de Producto</button>
        </div>
        {{ csrf_field() }}

    </form>
<div class="panel-body">
    <table class="table table-hover" id="table-producto">
                  <thead class="thead-inverse">
                      <tr>
                          <th>Nombre Subcategoria</th>
                          <th>Acciones</th>
                      </tr>
                  </thead>
              </table>
  </div>
@stop
@push('scripts')

<script type="text/javascript">

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });

  var table;

  $(function() {

    table = $('#table-producto').DataTable({
            processing: true,
            serverSide: true,
            ajax:'{{URL::asset('/subcategoriaproductos/data')}}',
            columns: [
                { data: 'nombresubcategoriaproducto', name: 'nombresubcategoriaproducto' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            language: {
                lengthMenu: "Mostrando _MENU_ registros por pagina",
                zeroRecords: "Nada encontrado - lo siento",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "Ningún registro disponible",
                emptyTable: "No hay datos en la tabla",
                infoFiltered: "(encontrados de _MAX_ registros totales)",
                search: "<i class='glyphicon glyphicon-search'></i>",
                  paginate: {
                      previous: "Ant",
                      next: "Sig",
                      last: "Último",
                      first: "Primero",
                      page: "Página",
                      pageOf: "de"
              }
            }
        });

    });

  function btnDeleteSubCategoriaProducto(subcategoriaproducto)
{
  var url="/subcategoriaproductos/" + subcategoriaproducto + "/delete";
  var data = {idsubcategoriaproducto:subcategoriaproducto}

    $.post(url, data, function(response){
      if(response.success)
      {
             table.ajax.reload();
      }
      else
      {
        alert("FAIL");
      }
  }, 'json');
}
</script>
@endpush