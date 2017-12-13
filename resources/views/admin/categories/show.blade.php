@extends('layouts.admin')

@section('content')
	<h1>Exibir Categoria</h1>
	
	<div class="col-sm-12">

		{!! Form::model($category, ['method'=>'HEAD', 'action'=>['AdminCategoriesController@update', $category->id], 'files'=>true]) !!}
				{{ csrf_field() }}
			
			<div class="form-group">
				{!! Form::label('name',   'Nome:') !!} 
				{!! Form::text('name', null, ['class'=>'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('body',   'Descrição:') !!} 
				{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
			</div>
		
		{!! Form::close() !!}
		{!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}
			<div class="form-group">    	
				{!! Form::submit('Excluir Categoria', ['class'=>'btn btn-danger col-sm-6']) !!}
			</div>
		{!! Form::close() !!}
	</div>
	<div class="col-sm-12">	
		<br>
		@include('includes.form_errors')
	</div>	
	

    


@endsection
@section('footer')