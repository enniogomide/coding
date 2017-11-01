@extends('layouts.admin')

@section('content')
	<h1>Incluir novo Usuário</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true]) !!}
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
    		{!! Form::label('is_active', 'Situação:') !!} {!! Form::select('is_active', array(1=>'Ativo', 0=>'Inativo'), 0, ['class'=>'form-control']) !!}
    	</div>
		<div class="form-group">
    		{!! Form::label('foto', 'foto:') !!} {!! Form::file('foto', null, ['class'=>'form-control']) !!}
    	</div>		
		<br><br>
	
    	<div class="form-group">    	
    		{!! Form::submit('Incluir Usuário', ['class'=>'btn btn-primary']) !!}
   		</div>
   		
    {!! Form::close() !!}
    
	@include('includes.form_errors')

@endsection
@section('footer')