@extends('layouts.admin')

@section('content')
	@if (Session::has('Mídia Incluída'))
		<p class='bg-danger'>{{session('Mídia Incluída')}}</p>
	@endif
	@if (Session::has('Mídia Atualizada'))
		<p class='bg-danger'>{{session('Mídia Atualizada')}}</p>
	@endif
	@if (Session::has('Mídia Excluída'))
		<p class='bg-danger'>{{session('Mídia Excluída')}}</p>
	@endif
	@if (Session::has('Ação em Grupo'))
		<p class='bg-danger'>{{session('Ação em Grupo')}}</p>
	@endif
	@if (Session::has('Sem opção'))
		<p class='bg-danger'>{{session('Sem opção')}}</p>
	@endif			
<h1>Administração de Mídia</h1>
@if($photos)
	<form action="delete/media" method ="post" class="form-inline">
		{{csrf_field()}}
		{{method_field('delete')}}
		<div class="form-group">
			<select name="checkBox" id="" class="form-control">
				<option value="delete">Delete</option>
				<option value="atualizar">Atualizar</option>
			</select>
		<div class="form-group">
			<input type="submit" name="delete_grupo" class="btn-primary"></input>
		</div>		
			

		<div class="col-sm-12">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><input type="checkbox" id="options" ></th>
						<th>Edit</th>
						<th>Exc</th>
						<th>Exc</th>
						<th>Id</th>
						<th>Caminho / Arquivo</th>
						<th>Foto</th>
						<th>Incluída em</th>
					</tr>
				</thead>
				<tbody>
			
					@foreach($photos as $photo)
						<tr>
							<td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
							<td><a href="{{route('admin.medias.edit', $photo->id)}}"><img width="20" src="{{'/images/App/CRUD_update.png'}}" alt=""></a></td>
							<td>
								<input type="hidden" name="diretorioPhoto" value="{{$photo->file}}" </input>
								<input type="hidden" name="idDaPhoto" value="{{$photo->id}}" </input>
								<div class="form-group">    	
									<input type="submit" name="delete_single" value="Delete" class="btn btn-danger"
								</div>
							</td>
							<td>{{$photo->id}}</tmedias>
							<td>{{$photo->file}}</td>
							<td><img height="42" width="42" src="{{$photo->file ? $photo->file : '/images/no-foto.jpg'}}" alt=""></td>
							<td>{{$photo->created_at->format('d/m/Y H:i')}}</td>
						</tr>
					@endforeach
				
				</tbody>
			</table>
		</div>
	</form>
@endif  

<div class="col-sm-6">
</div>


@endsection

@section('scripts')
	<script>
		$(document).ready(function(){
			$('#options').click(function(){

				if(this.checked){

					$('.checkBoxes').each(function(){
						this.checked = true;
					})
				}else{
					$('.checkBoxes').each(function(){
						this.checked = false;
					})
				}
			}); 
		});
	</script> 
@stop
@section('footer')
@endsection