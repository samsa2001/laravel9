<div class="form-control">
    <label for="title">Titulo</label>
    <input type="text" name="title" class="form-control" id="title" value="{{ old('title',$post->title) }}">
    @error('title')
    <small class="text-red-500">{{$message}}</small>
    @enderror
</div>
<div class="form-control">
    <label for="url_clean">URL limpia</label>
    <input type="text" name="url_clean" class="form-control" value="{{ old('url_clean',$post->url_clean) }}">
    @error('url_clean')
    <small class="text-red-500">{{$message}}</small>
    @enderror
</div>
<div class="form-control">
    <label for="description">Descripción</label>
    <textarea id="description" name="description" class="form-control" rows="3">{{ old('description',$post->description) }}</textarea>

    @error('content')
    <small class="text-red-500">{{$message}}</small>
    @enderror
</div>
<div class="form-control">
    <label for="content">Contenido</label>
    <textarea id="content" name="content" class="form-control" rows="3">{{ old('content',$post->content) }}</textarea>

    @error('content')
    <small class="text-red-500">{{$message}}</small>
    @enderror
</div>
<div class="lg:flex flex-row">
    <div class="form-control lg:basis-1/3 lg:mr-3">
        <label for="category_id">Categoria</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $title=>$cat_id)
            <option {{ $post->category_id == $cat_id ? 'selected="selected"':''}} value="{{ $cat_id }}">{{ $title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-control lg:basis-1/3 lg:mr-3">
        <label for="tags">Etiquetas</label>
        <select name="tags[]" id="tags" class="form-control" multiple>
            @foreach ($tags as $title=>$tag_id)
            <option {{ in_array($tag_id,old('tags') ?: $post->tags()->pluck('tag_id')->toArray())  ? 'selected="selected"':''}} value="{{ $tag_id }}">{{ $title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-control lg:basis-1/3 lg:ml-3">
        <label for="posted">Publicado</label>
        <select name="posted" class="form-control">
            <option {{ $post->posted == 'not' ? 'selected="selected"':''}} value="not">No</option>
            <option {{ $post->posted == 'yes'  ? 'selected="selected"':''}} value="yes">Sí</option>
        </select>
    </div>
</div>
@if ( isset($task) && $task == 'edit' )
<div class="form-control mt-2">
    <label for="imagen">Imagen</label>
    <input type="file" name="image" id="imagen">
</div>
@endif
<input type="submit" value="Enviar" class="btn btn-slate my-3">