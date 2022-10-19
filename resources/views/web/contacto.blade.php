@extends ('backend.layout')
@section ('content')
<h1>Contacta con nosotros</h1>
<form action="{{ route('web.send.contacto') }}" method="POST">
    @csrf
    <div class="form-control">
        <label for="name">Nombre</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
        @error('name')
        <small class="text-red-500">{{$message}}</small>
        @enderror
    </div>
    <div class="form-control">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        @error('email')
        <small class="text-red-500">{{$message}}</small>
        @enderror
    </div>
    <div class="form-control">
        <label for="content">Contenido</label>
        <textarea id="content" name="content" class="form-control" rows="3">{{ old('content') }}</textarea>

        @error('content')
        <small class="text-red-500">{{$message}}</small>
        @enderror
    </div>
    <input type="submit" value="Enviar" class="btn btn-slate my-3">
</form>
@endsection