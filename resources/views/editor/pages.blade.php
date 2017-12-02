@extends('layouts.editor')

@section('editor.content')
	<!-- List group -->
	<ul class="list-group">
		@foreach($sections as $section)

		    <h1>{{ $section->name }}</h1>

		    @if (count($section->pages))
		        @foreach($section->pages as $page)
		            {{ $page->address }}
		        @endforeach
		    @else
		        No pages Found
		    @endif

		@endforeach
	</ul>
@endsection
