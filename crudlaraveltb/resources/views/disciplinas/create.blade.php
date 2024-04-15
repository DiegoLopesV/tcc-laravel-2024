@extends('layouts.app-master') @section('content')

<div class="bg-light p-4 rounded">
	<h1>Disciplinas</h1>
	<div class="lead">Dados da disciplina</div>

	<div class="mt-2">@include('layouts.partials.messages')</div>

	<div class="container mt-4">
		<form method="POST" action="">
			@csrf
			<div class="mb-3">
				<label for="nome" class="form-label">Nome</label> <input
					value="{{ old('nome') }}" type="text" class="form-control"
					name="nome" placeholder="Nome" required> @if ($errors->has('nome'))
				<span class="text-danger text-left">{{ $errors->first('nome') }}</span>
				@endif
			</div>

			<div class="mb-3">
				<label for="curso" class="form-label">Curso</label> <input
					value="{{ old('curso') }}" type="text" class="form-control"
					name="curso" placeholder="Curso" required>
					@if ($errors->has('curso')) <span class="text-danger text-left">{{
					$errors->first('curso') }}</span> @endif
			</div>

			<div class="mb-3">
				<label for="sigla" class="form-label">Sigla</label> <input
					value="{{ old('sigla') }}" type="text" class="form-control"
					name="sigla" placeholder="Sigla" required>
					@if ($errors->has('sigla')) <span class="text-danger text-left">{{
					$errors->first('sigla') }}</span> @endif
			</div>

			<div class="mb-3">
				<label for="carga_horaria" class="form-label">Carga horária</label>
				<input value="{{ old('carga_horaria') }}" type="number"
					class="form-control" name="carga_horaria"
					placeholder="Carga horária" required>
					@if ($errors->has('carga_horaria')) <span class="text-danger text-left">{{
					$errors->first('carga_horaria') }}</span> @endif
			</div>

			<div class="mb-3">
				<label for="nome_professor" class="form-label">Nome do professor</label>
				<br><select name="profs" id="profs"></br>
				@foreach($professores as $professor)
					<option value="{{ $professor->id }}">{{ $professor->nome}}</option>
				@endforeach
				</select>
				
			</div>

			

			<button type="submit" class="btn btn-success">Salvar</button>
			<a href="{{ route('disciplinas.index') }}" class="btn btn-danger">Cancelar</a>
		</form>
	</div>


</div>


@endsection
