@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="col-md-12">
			<div class="page-header">
				<h1>{{ $page_version->title }}</h1>
			</div>
		</div>
	</div>
    <div class="row">
        <div class="col-sm-9">
			<ol>
			@foreach($subtitles as $i => $subtitle)
				<li><a href="#{{ $subtitles_ids[$i] }}">{{ $subtitle }}</a></li>
			@endforeach
			</ol>
			{!! $page_version->content !!}
        </div>
		<div class="col-sm-3">
			<!-- List group -->
			<span class="bottom-margin">{{ $section->name }}</span>
			<nav>
				@foreach($pages_menu as $page)
					<a class="btn btn-link btn-link-vertical-menu {{ Request::is($page->address) ? 'custom_active' : '' }}" href="{{ url($page->address) }}">
						{{ $page->page_versions->first()->title }}
					</a>
				@endforeach
			</nav>
		</div>
    </div>
</div>
@endsection
