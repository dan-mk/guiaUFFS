@extends('layouts.admin')

@section('admin.content')
	<div class="page-header">
		<h1>{{ $section->name }}</h1>
	</div>
    <div class="panel panel-default">
        <div class="panel-heading">Permissões</div>

        <div class="panel-body">
			<!-- List group -->
			<ul class="list-group list-group-pages">
				@foreach($users as $user)
					<li class="list-group-item" >
						<span>{{ $user->name }}</span>
						@if($user->sections()->get()->contains($section))
							<a class="btn btn-link btn-list-link pull-right" href="{{ route('sections.permissions.remove', [$section->id, $user->id]) }}">Tirar permissão</a>
						@else
							<a class="btn btn-link btn-list-link pull-right" href="{{ route('sections.permissions.add', [$section->id, $user->id]) }}">Adicionar permissão</a>
						@endif
					</li>
				@endforeach
			</ul>
        </div>
    </div>
@endsection
