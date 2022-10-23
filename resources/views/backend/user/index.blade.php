@extends('backend.layout')
@section('content')  
<h1>Tabla de usuarios</h1>
<a href="{{ route('user.create') }}" class="btn btn-green">Crear usuario</a>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>   
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{ $user->email }}</td>
            <td>{{$user->rol}}</td>
            <td class="flex flex-row">
                <a href="{{ route('user.edit',$user) }}" class="btn btn-small btn-slate mx-1">Editar</a>
                @if ($currentUser != $user->id)
                <form action="{{ route('user.destroy',$user) }}" method="post">
                  @method("DELETE")
                  @csrf
                  <button type="submit" class="btn btn-small btn-red ml-1">Borrar</button>
                </form>
                @endif
            </td>
        </tr>            
        @endforeach
    </tbody>
</table>


@endsection