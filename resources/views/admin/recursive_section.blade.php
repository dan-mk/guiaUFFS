<ul class="list-group">
@foreach($sections as $section)
	<li class="list-group-item">
		<span>{{ $section->name }}</span>
		@php
			$section_children = $section->children()->get()
		@endphp
		@if(count($section_children))
			@include('admin.recursive_section', ['sections' => $section_children])
		@endif
		<a class="btn btn-link pull-right" href="{{ route('sections.create') }}?parent_id={{ $section->id }}">
			Nova seção
		</a>
	</li>
@endforeach
</ul>
