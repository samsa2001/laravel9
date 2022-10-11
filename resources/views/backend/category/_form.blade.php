<div class="form-group">
    <label for="title">Titulo</label>
    <input type="text" name="title" class="form-control" id="title" value="{{ old('title',$category->title) }}">
    @error('title')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
<div class="form-group">
    <label for="url_clean">URL limpia</label>
    <input type="text" name="url_clean" class="form-control" value="{{ old('url_clean',$category->url_clean) }}">
    @error('url_clean')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
<input type="submit" value="Enviar" class="btn btn-slate my-3">