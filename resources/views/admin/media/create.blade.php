@extends('layouts.admin')

@section('content')
	<h1>Nova Categoriat</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store', 'files'=>true]) !!}
    		{{ csrf_field() }}
    	
		<div class="form-group">
    		{!! Form::label('name',   'Nome:') !!} 
			{!! Form::text('name', null, ['class'=>'form-control']) !!}
    	</div>
		<div class="form-group">
    		{!! Form::label('body',   'Descrição:') !!} 
			{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
    	</div>
		<br>	
    	<div class="form-group">    	
    		{!! Form::submit('Incluir Categoria', ['class'=>'btn btn-primary']) !!}
   		</div>
   		
    {!! Form::close() !!}
    
	@include('includes.form_errors')

@endsection
@section('footer')