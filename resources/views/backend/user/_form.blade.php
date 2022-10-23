<div class="form-control">
    <label for="name">Nombre</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ old('name',$user->name) }}">
    @error('name')
    <small class="text-red-500">{{$message}}</small>
    @enderror
</div>
@if ( !isset($task) )
<div class="form-control">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}">
    @error('email')
    <small class="text-red-500">{{$message}}</small>
    @enderror
</div>
@endif
<div class="form-control">
    <label for="password">Contraseña</label>
    <input type="password" name="password" class="form-control" value="{{ old('password',$user->password) }}">
    @error('password')
    <small class="text-red-500">{{$message}}</small>
    @enderror
</div>
@if (isset($task) && $currentUser != $user->id || !isset($currentUser))
<div class="form-control lg:w-2/5">
    <label for="rol">Rol</label>
    <select name="rol" class="form-control">
        <option {{ $user->rol == 'admin' ? 'selected="selected"':''}} value="admin">Administrador</option>
        <option {{ $user->rol == 'regular'  ? 'selected="selected"':''}} value="regular">Suscriptor</option>
    </select>
</div>
@endif
<input type="submit" value="Enviar" class="btn btn-slate my-3">  
<a href="{{ route('user.index') }}" class="btn  bg-yellow-300 mx-1">Cancelar</a>