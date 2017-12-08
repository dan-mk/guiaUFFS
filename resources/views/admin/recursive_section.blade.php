@foreach($sections as $section)
	<li class="list-group-item">
		<div class="list-header">
			<span>{{ $section->name }}</span>
			<a class="btn btn-link btn-list-link pull-right" href="{{ route('sections.edit', $section->id) }}">
				Editar
			</a>
			<a class="btn btn-link btn-list-link pull-right" target="_blank" href="{{ $section->complete_subdomain() == '' ? route('main.home') : route('home', $section->complete_subdomain()) }}">
				Ver
			</a>
		</div>
		@php
			$section_children = $section->children()->get()
		@endphp
		<ul class="list-group no-margins">
		@if(count($section_children))
			@include('admin.recursive_section', ['sections' => $section_children])
		@endif
			<li class="list-group-item">
				<a class="btn btn-link btn-list-link no-margins" href="{{ route('sections.create') }}?parent_id={{ $section->id }}">
					Nova seção
				</a>
			</li>
		</ul>
	</li>
@endforeach
