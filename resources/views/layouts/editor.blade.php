@extends('layouts.app')

@section('content')
<div class="container container-sm-narrow">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 great-content">
			<ul class="nav nav-tabs nav-justified">
				<li role="presentation" class="{{ $active_pages ?? '' }}">
					<a href="{{ route('editor.pages') }}">Páginas</a>
				</li>
				<li role="presentation" class="{{ $active_groups ?? '' }}">
					<a href="{{ route('editor.groups') }}">Grupos</a>
				</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-body">
					@yield('editor.content')
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
