

	<h1>{{ $modo }} producto</h1>

    @if(count($errors)>0)

        <div class="alert alert-danger" role="alert">
           <ul>
                @foreach($errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        
        
    @endif

    <div class="form-group" >

        <label for="Nombre">Nombre</label>
        <input type="" class="form-control" name="Nombre" value="{{ isset($producto->Nombre)?$producto->Nombre:old('Nombre') }}" id="Nombre"> {{-- isset(dato a validar)? sino dato:'vacio' pregunta si existe un valor  --}}
    </div>
    
    <div class="form-group" >
        <label for="Descripcion">Descripcion</label>
        <input type="" class="form-control" name="Descripcion" value="{{ isset($producto->Descripcion)?$producto->Descripcion:old('Descripcion') }}" id="Descripcion">
    </div>

    <div class="form-group" >
        <label for="Cantidad">Cantidad</label>
        <input type="" class="form-control" name="Cantidad" value="{{ isset($producto->Cantidad)?$producto->Cantidad:old('Cantidad') }}" id="Cantidad">
    </div>

    <div class="form-group" >
        <label for="Foto"></label>

        @if(isset($producto->Foto))
        <img class="img-thumbnail img-fluit" src="{{ asset('storage').'/'.$producto->Foto }}" width="250" alt="">  {{-- mostrar foto --}}
        @endif

        <input type="file" class="form-control" name="Foto" value="" id="Foto">
    </div>

    <input class="btn btn-success" type="submit" value="{{ $modo }}">



    <a href="{{ url('producto/') }}" class="btn btn-primary">Regresar</a> 
  