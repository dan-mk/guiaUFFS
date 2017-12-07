@extends('layouts.admin')

@section('admin.content')
	<div class="page-header">
		<h1>{{ $parent_section->name }}</h1>
	</div>
    <div class="panel panel-default">
        <div class="panel-heading">Editar seção</div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('sections.update', $section->id) }}">
                {{ csrf_field() }}

				<input name="_method" type="hidden" value="PUT">

				<div class="form-group{{ ($errors->has('subdomain') or $errors->has('subdomain_doesnt_exist')) ? ' has-error' : '' }}">
                    <label for="subdomain" class="col-md-12">Subdomínio</label>

                    <div class="col-md-12">
                        <input id="subdomain" type="text" class="form-control" name="subdomain" value="{{ old('subdomain') ?? $section->subdomain }}" required>

                        @if($errors->has('subdomain'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subdomain') }}</strong>
                            </span>
                        @endif

						@if($errors->has('subdomain_doesnt_exist'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subdomain_doesnt_exist') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-12">Nome</label>

                    <div class="col-md-12">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?? $section->name }}" required>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group bottom-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">
                            Salvar alterações
                        </button>
						<a href="{{ route('sections.index') }}" class="btn btn-danger">
							Cancelar
						</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
