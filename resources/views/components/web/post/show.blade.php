<div>
{{ $getTitle() }}
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Categoría</th>
            <th>Posteado</th>   
            <th>Imagen</th>
            <th>Creación</th>
            <th>Actualizacion</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$post->id}}</td>
            <td>{{ $post->category->title }}</td>
            <td>{{$post->posted}}</td>
            <td>{{$post->image}}</td>
            <td>{{$post->created_at->format('d-m-Y')}}</td>
            <td>{{$post->updated_at->format('d-M-Y')}}</td>
        </tr>        
    </tbody>
</table>
</div>