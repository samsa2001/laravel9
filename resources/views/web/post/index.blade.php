@extends('web.layout')
@section('content')  
<x-web.post.index :posts="$posts" >
    <h1>Tabla de contenidos</h1>
</x-web.post.index>


@endsection