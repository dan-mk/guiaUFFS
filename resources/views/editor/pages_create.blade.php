@extends('layouts.editor')

@section('editor.content')
<div class="container container-form">
    <div class="row">
        <div class="col-md-12">
			<div class="page-header">
				<h1>{{ $section->name }}</h1>
			</div>
            <div class="panel panel-default">
                <div class="panel-heading">Nova página</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('paginas.store') }}">
                        {{ csrf_field() }}

						<input name="section_id" type="hidden" value="{{ $request->section_id }}">

						<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-12">Endereço de acesso</label>

                            <div class="col-md-12">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-12">Título</label>

                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12">Conteúdo</label>

                            <div class="col-md-12">
								<textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content') }}</textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group bottom-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Criar página
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
