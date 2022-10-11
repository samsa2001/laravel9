@extends('backend.layout')
@section('content')  
<h1>Tabla de contenidos</h1>
<a href="{{ route('category.create') }}" class="btn btn-primary btn-sm my-3">Crear category</a>
<table class="table">
    <thead>
        <tr>
            <td>Id</td>
            <td>Titulo</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->title}}</td>
            <td>
                <a href="{{ route('category.show',$category) }}" class="btn btn-primary">Ver</a> 
                <a href="{{ route('category.edit',$category) }}" class="btn btn-warning">Editar</a> 
                <form action="{{ route('category.destroy',$category) }}" method="POST">
                  @method("DELETE")
                  @csrf
                  <button type="submit">Borrar</button>
                </form>
            </td>
        </tr>            
        @endforeach
    </tbody>
</table>
{{ $categories -> links() }}


@endsection