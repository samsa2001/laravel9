@extends ('backend.layout')
@section ('content')
    <h1>Actualizar un post: {{ $post->title }}</h1>
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        @include("backend.post._form",['task'=>'edit'])
    </form>
@endsection