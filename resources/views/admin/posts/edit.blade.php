@extends('layouts.admin')

@section('content')
	<h1>Atualizar Post</h1>
	
	<div class="col-sm-2">
		<img height="42" src="{{$post->photo ? $post->photo->file : '/images/no-foto.jpg'}}" alt="" class="img-responsive img-rounded">
		<br>
	</div>
	<div class="col-sm-9">

		{!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostController@update', $post->id], 'files'=>true]) !!}
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
				{!! Form::select('category_id', [''=> 'escolha uma opção'] + $categories, null, ['class'=>'form-control']) !!}
			</div>			
			<div class="form-group">
				{!! Form::label('user_id',   'Autor:') !!} 
				{!! Form::select('user_id', [''=> 'escolha uma opção'] + $users, null, ['class'=>'form-control']) !!}
			</div>		
			<div class="form-group">
				{!! Form::label('photo_id', 'foto destaque:') !!} 
				{!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
			</div>		
			<div class="form-group">    	
				{!! Form::submit('Alterar Post', ['class'=>'btn btn-primary col-sm-6']) !!}
			</div>
			
		{!! Form::close() !!}
	</div>
	<div class="col-sm-12">	
		<br>
		@include('includes.form_errors')
	</div>	
	

    


@endsection
@section('footer')