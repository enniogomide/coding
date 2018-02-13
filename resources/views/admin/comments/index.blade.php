@extends('layouts.admin')

@section('content')
	@if (Session::has('Comentário Excluído'))
		<p class='bg-danger'>{{session('Comentário Excluído')}}</p>
	@endif
	@if (Session::has('Comentário Atualizado'))
		<p class='bg-danger'>{{session('Comentário Atualizado')}}</p>
	@endif
	@if (Session::has('Sem respostas'))
		<p class='bg-danger'>{{session('Sem respostas')}}</p>
	@endif		
	@if($comments)
		<h1>Gestão de comentários</h1>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Apv</th>
					<th>Exc</th>
					<th>post</th>
					<th>Respostas</th>
					<th>Atv</th>
					<th>id</th>
					<th> </th>
					<th>autor</th>
					<th>email</th>
					<th>Texto</th>
					<th>Incluído em</th>
				</tr>
			</thead>
			
			<tbody>
				@foreach($comments as $comment)
					<tr>
						<td>
								@if($comment->is_active == 0)
									{!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
											<input type="hidden" name="is_active" value="1">
											<div class="form-group">    	
												{!! Form::submit('APV', ['class'=>'btn btn-primary']) !!}
											</div>
									{!! Form::close() !!}
								@else
									{!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
											<input type="hidden" name="is_active" value="0">
											<div class="form-group">    	
												{!! Form::submit('DPV', ['class'=>'btn btn-info']) !!}
											</div>
									{!! Form::close() !!}
								@endif                    
						</td>
						<td>
								{!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
										<div class="form-group">    	
											{!! Form::submit('EXC', ['class'=>'btn btn-danger']) !!}
										</div>
							{!! Form::close() !!}                    
						</td>					
						<td><a href="{{route('home.post', $comment->post_id)}}">Ver Post</a></td>
						<td><a href="{{route('admin.replies.show', $comment->id)}}">Ver Respostas</a></td>
						<td>{{$comment->is_active == 0? 'N' : 'S'}}</td>
						<td>{{$comment->id}}</td>
						<td><img height="42" width="42" src="{{$comment->photo ? $comment->photo : '/images/no-foto.jpg'}}" alt=""></td>
						<td>{{str_limit($comment->author, 20)}}</td>
						<td>{{str_limit($comment->email, 20)}}</td>
						<td>{{str_limit($comment->body, 30)}}</td>
						<td>{{$comment->created_at->format('d/m/Y H:i')}}</td>
					</tr>
				@endforeach
			</tbody>
  	</table>
	@else
			<h1 class="text-center">Sem comentário</h1>
	@endif

@endsection
@section('footer')