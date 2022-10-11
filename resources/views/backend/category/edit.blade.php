@extends ('backend.layout')
@section ('content')
    <h1>Actualizar un category: {{ $category->title }}</h1>
    <form action="{{ route('category.update', $category->id) }}" method="POST">
        @csrf
        @method("PATCH")
        @include("backend.category._form",['task'=>'edit'])
    </form>
@endsection