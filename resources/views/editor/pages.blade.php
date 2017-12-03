@extends('layouts.editor')

@section('editor.content')
	<!-- List group -->
	<ul class="list-group">
		@foreach($sections as $section)
			<li class="list-group-item">
			    <span>{{ $section->name }}</span>
				<a class="btn btn-link pull-right" href="{{ route('pages.create') }}?section_id={{ $section->id }}">
					Nova página
				</a>
				<ul>
			    @if(count($section->pages))
			        @foreach($section->pages as $page)
						<li class="list-group-item">
							{{ $page->page_versions->first()->title }}
							<a class="btn btn-link pull-right" href="{{ route('pages.edit', $page->id) }}">
								Editar página
							</a>
							<a class="btn btn-link pull-right" href="{{ route('page', [$section->subdomain, $page->address]) }}">
								Ver página
							</a>
						</li>
			        @endforeach
			    @else
			        <li class="list-group-item">Nenhuma página criada nesta seção.</li>
			    @endif
				</ul>
			</li>
		@endforeach
	</ul>
@endsection
