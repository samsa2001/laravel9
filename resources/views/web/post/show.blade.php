@extends('web.layout')
@section('content')  
<x-web.post.show :post="$post" >
    <h1>Post</h1>
</x-web.post.show>


@endsection