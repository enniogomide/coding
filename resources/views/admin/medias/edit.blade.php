@extends('layouts.admin')

@section('content')
	<h1>Atualizar Categoria</h1>
	
	<div class="col-sm-9">

		{!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id], 'files'=>true]) !!}
				{{ csrf_field() }}
			
			<div class="form-group">
				{!! Form::label('name',   'Name:') !!} 
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('body',   'Descrição:') !!} 
				{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">    	
				{!! Form::submit('Alterar Categoria', ['class'=>'btn btn-primary col-sm-6']) !!}
			</div>
			
		{!! Form::close() !!}
	</div>
	<div class="col-sm-12">	
		<br>
		@include('includes.form_errors')
	</div>	

@endsection
@section('footer')