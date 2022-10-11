@extends('backend.layout')
@section('content')  
<h1>Tabla de contenidos</h1>
<a href="{{ route('category.create') }}" class="btn btn-green my-3">Crear category</a>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->title}}</td>
            <td class="flex flex-row">
                <a href="{{ route('category.show',$category) }}" class="btn btn-small btn-green mr-1">Ver</a> 
                <a href="{{ route('category.edit',$category) }}" class="btn btn-small btn-slate mr-1">Editar</a> 
                <form action="{{ route('category.destroy',$category) }}" method="POST">
                  @method("DELETE")
                  @csrf
                  <button type="submit" class="btn btn-small btn-red mr-1">Borrar</button>
                </form>
            </td>
        </tr>            
        @endforeach
    </tbody>
</table>
{{ $categories -> links() }}


@endsection