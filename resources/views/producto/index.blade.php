@extends('layouts.app')

@section('content')
<div class="container">


	@if(Session::has('mensaje'))
		<div class="alert alert-success alert-dismissible" role="alert">
		{{ Session::get('mensaje') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="close" >
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif


	



<a href="{{ url('producto/create') }}" class="btn btn-success " >Nuevo producto</a> 

<br/>
<br/>

<table class="table table-dark">
	<thead class="thead-dark">
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>Cantidad</th>
            <th>Foto</th>
			<th>Acciones</th>
		</tr>
	</thead>

	<tbody>
		@foreach($productos as $producto)
		<tr>
			<td>{{ $producto->id }}</td>
			<td>{{ $producto->Nombre }}</td>
			<td>{{ $producto->Descripcion }}</td>
			<td>{{ $producto->Cantidad }}</td>
			
          	
			<td>
				
				<img class="img-thumbnail img-fluit" src="{{ asset('storage').'/'.$producto->Foto }}" width="250" alt="">  {{-- mostrar foto --}}

			</td>


			<td> 

			<a href="{{ url('/producto/'.$producto->id.'/edit') }}" class="btn btn-warning"  > Editar </a>
				

			<form action="{{ url('/producto/'.$producto->id ) }}" class="d-inline" method="POST" >
			@csrf
			{{ method_field('DELETE') }}	
				<input type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro de querer borrar el producto?')" value="Borrar">
			</form>	

			</td>
		</tr>
		@endforeach
	</tbody>

</table>

{!! $productos->links() !!}  {{-- mostrar paginacion de tabla agregar paginator en Providers/AppServiceprovider--}}

</div>
@endsection