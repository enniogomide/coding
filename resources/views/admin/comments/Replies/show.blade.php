@extends('layouts.admin')

@section('content')
	@if (Session::has('Resposta Comentário Excluída'))
		<p class='bg-danger'>{{session('Resposta Comentário Excluída')}}</p>
	@endif
	@if (Session::has('Resposta Comentário Atualizada'))
		<p class='bg-danger'>{{session('Resposta Comentário Atualizada')}}</p>
	@endif	
	@if($commentreplies)
		<h1>Gestão de Respostas a comentários</h1>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Apv</th>
					<th>Exc</th>
                    <th>post</th>
                    <th>Coment</th>
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
				@foreach($commentreplies as $commentreply)
					<tr>
						<td>
								@if($commentreply->is_active == 0)
									{!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $commentreply->id]]) !!}
											<input type="hidden" name="is_active" value="1">
											<input type="hidden" name="comment_id" value="{{$commentreply->comment_id}}">
											<div class="form-group">    	
												{!! Form::submit('APV', ['class'=>'btn btn-primary']) !!}
											</div>
									{!! Form::close() !!}
								@else
									{!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $commentreply->id]]) !!}
											<input type="hidden" name="is_active" value="0">
											<input type="hidden" name="comment_id" value="{{$commentreply->comment_id}}">
											<div class="form-group">    	
												{!! Form::submit('DPV', ['class'=>'btn btn-info']) !!}
											</div>
									{!! Form::close() !!}
								@endif                    
						</td>
						<td>
								{!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $commentreply->id]]) !!}
										<input type="hidden" name="comment_id" value="{{$commentreply->comment_id}}">
										<div class="form-group">    	
											{!! Form::submit('EXC', ['class'=>'btn btn-danger']) !!}
										</div>
							{!! Form::close() !!}                    
						</td>					
                        <td><a href="{{route('home.post', $commentreply->comment->post_id)}}">Voltar Post</a></td>
                        <td><a href="{{route('admin.comments.index')}}">Voltar Comentário</a></td>
						<td>{{$commentreply->is_active == 0? 'N' : 'S'}}</td>
						<td>{{$commentreply->id}}</td>
						<td><img height="42" width="42" src="{{$commentreply->photo ? $commentreply->photo : '/images/no-foto.jpg'}}" alt=""></td>
						<td>{{str_limit($commentreply->author, 20)}}</td>
						<td>{{str_limit($commentreply->email, 20)}}</td>
						<td>{{str_limit($commentreply->body, 30)}}</td>
						<td>{{$commentreply->created_at->format('d/m/Y H:i')}}</td>
					</tr>
				@endforeach
			</tbody>
  	</table>
	@else
			<h1 class="text-center">Sem Resposta a comentário</h1>
	@endif

@endsection
@section('footer')