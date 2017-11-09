@extends('layouts.admin')

@section('content')
	@if (Session::has('Usuário Incluído'))
		<p class='bg-danger'>{{session('Usuário Incluído')}}</p>
	@endif
	@if (Session::has('Usuário Atualizado'))
		<p class='bg-danger'>{{session('Usuário Atualizado')}}</p>
	@endif
	@if (Session::has('Usuário Excluído'))
		<p class='bg-danger'>{{session('Usuário Excluído')}}</p>
	@endif	
<h1>Administração de usuários</h1>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Alt</th>
		<th>Id</th>
		<th>foto</th>
        <th>Name</th>
        <th>email</th>
		<th>Papel</th>
		<th>Situação</th>
		<th>Incluído em</th>
		<th>Atualizado em</th>
      </tr>
    </thead>
    <tbody>
		@if($users)
			@foreach($users as $user)
				<tr>
					<td><a href="{{route('admin.users.edit', $user->id)}}">atu</a></td>
					<td>{{$user->id}}</td>
					<td><img height="42" width="42" src="{{$user->photo ? $user->photo->file : '/images/no-foto.jpg'}}" alt=""></td>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->role->name}}</td>
					<td>{{$user->is_active == 1 ? 'Ativo' : 'Inativo'}}</td>
					<td>{{$user->created_at}}</td>
					<td>{{$user->updated_at}}</td>
				</tr>
			@endforeach
		@endif
    </tbody>
  </table>
@endsection
@section('footer')