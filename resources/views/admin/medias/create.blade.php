@extends('layouts.admin')
@section('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">
$stop

@section('content')
	<h1>UpLoad Mídia</h1>
    {!! Form::open(['method'=>'POST', 'action'=>'AdminMediaController@store', 'class'=>'dropzone', 'files'=>true]) !!}
    		{{ csrf_field() }}
   
   		
    {!! Form::close() !!}
@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
@endsection