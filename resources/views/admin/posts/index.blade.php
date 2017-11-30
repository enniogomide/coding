@extends('layouts.admin')

@section('content')
	@if (Session::has('Post Incluído'))
		<p class='bg-danger'>{{session('Post Incluído')}}</p>
	@endif
	@if (Session::has('Post Atualizado'))
		<p class='bg-danger'>{{session('Post Atualizado')}}</p>
	@endif
	@if (Session::has('Post Excluído'))
		<p class='bg-danger'>{{session('Post Excluído')}}</p>
	@endif
<h1>Administração de Post</h1>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Edit</th>
		<th>Exc</th>
		<th>Id</th>
		<th>foto</th>
		<th>Categoria</th>
		<th>Título</th>
		<th>Autor</th>
		<th>Incluído em</th>
		<th>Atualizado em</th>
      </tr>
    </thead>
    <tbody>
		@if($posts)
			@foreach($posts as $post)
				<tr>
					<td><a href="{{route('admin.posts.edit', $post->id)}}"><img width="20" src="{{'/images/App/CRUD_update.png'}}" alt=""></a></td>
					<td><a href="{{route('admin.posts.show', $post->id)}}"><img width="20" src="{{'/images/App/CRUD_delete.png'}}" alt=""></a></td>
					<td>{{$post->id}}</td>
					<td><img width="60" src="{{$post->photo ? $post->photo->file : '/images/no-foto.jpg'}}" alt=""></td>
					<td>{{$post->category_id}}</td>
					<td>{{$post->title}}</td>
					<td>{{$post->user->name}}</td>
					<td>{{$post->created_at}}</td>
					<td>{{$post->updated_at}}</td>
				</tr>
			@endforeach
		@endif
    </tbody>
  </table>
@endsection
@section('footer')
