@extends('layouts.editor')

@section('editor.content')
	<div class="page-header">
		<h1>Páginas</h1>
	</div>
	<!-- List group -->
	<ul class="list-group no-margins">
		@foreach($sections as $section)
			<li class="list-group-item">
				<div class="list-header clear">
				    <span>{{ $section->name }}</span>
					<a class="btn btn-link btn-list-link pull-right" href="{{ route('pages.create') }}?section_id={{ $section->id }}">
						Nova página
					</a>
				</div>
				<ul class="list-group no-margins">
			    @if(count($section->pages))
			        @foreach($section->pages as $page)
						<li class="list-group-item">
							<span>{{ $page->page_versions->first()->title }}</span>
							<a class="btn btn-link btn-list-link pull-right" href="{{ route('pages.edit', $page->id) }}">
								Editar
							</a>
							<a class="btn btn-link btn-list-link pull-right" target="_blank" href="{{ $section->complete_subdomain() == '' ? route('main.page', $page->address) : route('page', [$section->complete_subdomain(), $page->address]) }}">
								Ver
							</a>
						</li>
			        @endforeach
			    @else
			        <li class="list-group-item gray-bg">Nenhuma página criada nesta seção.</li>
			    @endif
				</ul>
			</li>
		@endforeach
	</ul>
@endsection
