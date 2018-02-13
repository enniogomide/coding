@extends('layouts.admin')

@section('content')
	@if (Session::has('Categoria Incluída'))
		<p class='bg-danger'>{{session('Categoria Incluída')}}</p>
	@endif
	@if (Session::has('Categoria Atualizada'))
		<p class='bg-danger'>{{session('Categoria Atualizada')}}</p>
	@endif
	@if (Session::has('Categoria Excluída'))
		<p class='bg-danger'>{{session('Categoria Excluída')}}</p>
	@endif
<h1>Administração de Categoria</h1>
<div class="col-sm-6">	
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Edit</th>
		<th>Exc</th>
		<th>Id</th>
		<th>Nome</th>
		<th>Descrição</th>
		<th>Incluída em</th>
      </tr>
    </thead>
    <tbody>
		@if($categories)
			@foreach($categories as $category)
				<tr>
					<td><a href="{{route('admin.categories.edit', $category->id)}}"><img width="20" src="{{'/images/App/CRUD_update.png'}}" alt=""></a></td>
					<td><a href="{{route('admin.categories.show', $category->id)}}"><img width="20" src="{{'/images/App/CRUD_delete.png'}}" alt=""></a></td>
					<td>{{$category->id}}</td>
					<td>{{str_limit($category->name, 10)}}</td>
					<td>{{str_limit($category->body, 10)}}</td>
					<td>{{$category->created_at->format('d/m/Y H:i')}}</td>
				</tr>
			@endforeach
		@endif
    </tbody>
  </table>
 </div>
<div class="col-sm-6">
</div> 
@endsection
@section('footer')