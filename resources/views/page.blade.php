@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			<div class="page-header">
				<h1>{{ $page_version->title }}</h1>
			</div>
			<ol>
			@foreach($subtitles as $i => $subtitle)
				<li><a href="#{{ $subtitles_ids[$i] }}">{{ $subtitle }}</a></li>
			@endforeach
			</ol>
			{!! $page_version->content !!}
        </div>
    </div>
</div>
@endsection
