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
		<th>Post</th>
		<th>Comm</th>
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
					<td>{{$post->category? $post->category->name : 'sem categoria'}}</td>
					<td>{{str_limit($post->title, 20)}}</td>
					<td><a href="{{route('home.post', $post->slug)}}">View</a></td>
					<td><a href="{{route('admin.comments.index')}}">View</a></td>
					<td>{{$post->user? $post->user->name : 'sem autor'}}</td>
					<td>{{$post->created_at->format('d/m/Y H:i')}}</td>
					<td>{{$post->updated_at->format('d/m/Y H:i')}}</td>
				</tr>
			@endforeach
		@endif
    </tbody>
  </table>
	<div class="row">
			<div class="col-sm-6 col-sm-offset-5">
				{{$posts->render()}}
			</div>
	</div>
@endsection
@section('footer')
