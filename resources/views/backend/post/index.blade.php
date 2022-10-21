@extends('backend.layout')
@section('content')  
<h1>Tabla de contenidos</h1>
<a href="{{ route('post.create') }}" class="btn btn-green">Crear post</a>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Categoría</th>
            <th>Posteado</th>   
            <th>Imagen</th>
            <th>Etiquetas</th>
            <th>Creación</th>
            <th>Actualizacion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{ $post->category->title }}</td>
            <td>{{$post->posted}}</td>
            <td>
                @if ($post->image)
                <img src="{{ asset('image/otro/'.$post->image)}}">
                @endif
            </td>
            <td>
            @foreach($post->tags as $tag)
                <div class="mr-2 float-left">{{ $tag->title }}</div>
            @endforeach
            </td>
            <td>{{$post->created_at->format('d-m-Y')}}</td>
            <td>{{$post->updated_at->format('d-M-Y')}}</td>
            <td class="flex flex-row">
                <a href="{{ route('post.show',$post) }}" class="btn btn-small btn-green mr-1">Ver</a> 
                <a href="{{ route('post.edit',$post) }}" class="btn btn-small btn-slate mx-1">Editar</a> 
                <form action="{{ route('post.destroy',$post) }}" method="post">
                  @method("DELETE")
                  @csrf
                  <button type="submit" class="btn btn-small btn-red ml-1">Borrar</button>
                </form>
            </td>
        </tr>            
        @endforeach
    </tbody>
</table>
{{ $posts -> links() }}


@endsection