@forelse($genres as $genre)
<a href="{{ route('generos.show', $genre->id) }}">{{$genre -> name}}</a>

@empty
<p>No hay géneros disponibles</p>
@endforelse