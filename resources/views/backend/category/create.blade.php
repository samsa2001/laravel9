@extends ('backend.layout')
@section ('content')
    <h1>Crear un category</h1>
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        @include("backend.category._form")
    </form>
@endsection