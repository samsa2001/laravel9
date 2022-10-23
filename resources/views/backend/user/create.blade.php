@extends ('backend.layout')
@section ('content')
    <h1>Crear un usuario</h1>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        @include("backend.user._form")
    </form>
@endsection