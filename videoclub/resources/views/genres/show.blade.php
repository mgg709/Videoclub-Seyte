<p>{{$genre->name}}</p>
<a href="{{ route('generos.index') }}">Volver</a>
<a href=" {{route('generos.destroy', $genre->id) }}" class="btn btn-primary">Eliminar</a>