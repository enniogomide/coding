@extends('layouts.admin')

@section('content')
	<h1>Novo Post</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostController@store', 'files'=>true]) !!}
    		{{ csrf_field() }}
    	
		<div class="form-group">
    		{!! Form::label('title',   'Título:') !!} 
			{!! Form::text('title', null, ['class'=>'form-control']) !!}
    	</div>
		<div class="form-group">
    		{!! Form::label('body',   'Texto:') !!} 
			{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
    	</div>
		<div class="form-group">
    		{!! Form::label('category_id',   'Categoria:') !!} 
			{!! Form::select('category_id', [''=> 'escolha uma opção'], null, ['class'=>'form-control']) !!}
    	</div>
		<div class="form-group">
			{!! Form::label('user_id',   'Autor:') !!} 
			{!! Form::select('user_id', [''=> 'escolha uma opção'] + $users, null, ['class'=>'form-control']) !!}
		</div>		
		<div class="form-group">
    		{!! Form::label('photo_id', 'foto destaque:') !!} 
			{!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
    	</div>		
		<br>	
    	<div class="form-group">    	
    		{!! Form::submit('Incluir Post', ['class'=>'btn btn-primary']) !!}
   		</div>
   		
    {!! Form::close() !!}
    
	@include('includes.form_errors')

@endsection
@section('footer')