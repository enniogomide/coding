@extends('layouts.admin')

@section('content')
	<h1>Atualizar dados de Usuário</h1>
	
	<div class="col-sm-2">
		<img height="42" src="{{$user->photo ? $user->photo->file : '/images/no-foto.jpg'}}" alt="" class="img-responsive img-rounded">
		<br>
	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}
		<div class="form-group">    	
			{!! Form::submit('Excluir Registro', ['class'=>'btn btn-danger']) !!}
		</div>
     {!! Form::close() !!} 
	</div>
	<div class="col-sm-9">

		{!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}
				{{ csrf_field() }}
			
			<div class="form-group">
				{!! Form::label('name',   'Nome:') !!} {!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('email', 'email:') !!} {!! Form::email('email', null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('password', 'senha:') !!} {!! Form::password('password', ['class'=>'form-control']) !!}
			</div>		
			<div class="form-group">
				{!! Form::label('role_id', 'papel:') !!} {!! Form::select('role_id', ['' => 'escolha uma opção'] + $roles, null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('is_active', 'Situação:') !!} {!! Form::select('is_active', array(1=>'Ativo', 0=>'Inativo'), null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('photo_id', 'foto:') !!} {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
			</div>		
			<br>
		
			<div class="form-group">    	
				{!! Form::submit('Alterar Usuário', ['class'=>'btn btn-primary']) !!}
			</div>
			
		{!! Form::close() !!}
		
		@include('includes.form_errors')
	</div>	
	

    


@endsection
@section('footer')