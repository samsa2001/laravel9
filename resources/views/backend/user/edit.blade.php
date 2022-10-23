@extends ('backend.layout')
@section ('content')
    <h1>Crear un usuario</h1>
    <form action="{{ route('user.update',$user->id) }}" method="POST">
        @csrf
        @method("PATCH")
        @include("backend.user._form",['task'=>'edit'])
    </form>
@endsection