@extends('layouts.blog-posts')

@section('content')
    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Publicado em {{$post->created_at->format('d/m/Y H:i')}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive img-rounded" src="{{$post->photo ? $post->photo->file : null}}" alt="">
    <!-- <img class="img-responsive img-rounded" src="{{$post->photo ? $post->photo->file : $post->photoPlaceHolder()}}" alt=""> -->

    <hr>

    <!-- Post Content -->
    <p class="lead">Categoria: {{$post->category->name}}</p>
    {!! $post->body !!}
    <hr>
    @if (Auth::check())
        <!-- Blog Comments -->
        @if (Session::has('Comentário Incluído'))
            <p class='bg-danger'>{{session('Comentário Incluído')}}</p>
        @endif
        @if (Session::has('Resposta a comentário Incluída'))
            <p class='bg-danger'>{{session('Resposta a comentário Incluída')}}</p>
        @endif        
        <!-- Comments Form -->
        <div class="well">
            <h4>Deixe teu comentário:</h4>

            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store', 'files'=>true]) !!}
                {{ csrf_field() }}

                <input type="hidden" name="post_id" value="{{$post->id}}">
                <div class="form-group">
                    {!! Form::label('body',   'Comentário:') !!} 
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                </div>
                <div class="form-group">    	
                    {!! Form::submit('Enviar', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}

        </div>

        <hr>

        <!-- Posted Comments -->

        <!-- Comment -->
        @if (count($comments) > 0)
            @foreach ($comments as $comment)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height="42" width="42" class="media-object"  src="{{$comment->photo ? $comment->photo : '/images/no-foto.jpg'}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}} 
                            <br> <small>{{$comment->email}} </small>
                            <br> <small>{{$comment->created_at->format('d/m/Y H:i')}}</small>
                        </h4>
                        <p>{{$comment->body}}</p>
                        <!-- Nested Comment -->
                        <div id="nested-commment" class="media">
                            @if (count($commentsreplies) > 0)
                                @foreach ($commentsreplies as $commentreply)

                                        @if ($comment['id'] == $commentreply['comment_id'] || $commentsreplies['is_active' == 1])                        
                                            <a class="pull-left" href="#">
                                                <!-- <img height="42" width="42" class="media-object"  src="{{$comment->photo ? $commentreply->photo : '/images/no-foto.jpg'}}" alt=""> -->
                                                <img height="42" width="42" class="media-object"  src="{{Auth::user()->gravatar}}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{$commentreply->author}} 
                                                    <br> <small>{{$commentreply->email}} </small>
                                                    <br> <small>{{$commentreply->created_at->format('d/m/Y H:i')}}</small>
                                                </h4>
                                                <p>{!! $commentreply->body !!}</p>
                                            </div>
                                        @endif
                                @endforeach
                            @endif
                            <div class="comment-reply-container">
                                
                                <button class="toggle-reply btn btn-primary pull-right">Responder</button>
                                
                                <div class="comment-reply col-sm-12">
                                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@store']) !!}
                                        {{ csrf_field() }}

                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                        <div class="form-group">
                                            {!! Form::label('body',   'Resposta:') !!} 
                                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>2]) !!}
                                        </div>
                                        <div class="form-group">    	
                                            {!! Form::submit('Enviar', ['class'=>'btn btn-primary']) !!}
                                        </div>

                                    {!! Form::close() !!}
                                </div>
                            </div>                                                        
                        </div>
    
                        <!-- End Nested Comment -->                        
                    </div>
                </div>
            @endforeach
        @endif    

        <!-- Comment -->
    @endif	    



@endsection

@section('footer')
@stop

@section('scripts')
    <script>
        $(".comment-reply-container .toggle-reply").click(function(){
            $(this).next().slideToggle("slow");

        });
    </script>
@stop