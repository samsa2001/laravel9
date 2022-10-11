@extends ('backend.layout')
@section ('content')
    <h1>Post: {{ $post->title }}</h1>
    <div>
        {{ $post-> content }}
    </div>

@endsection