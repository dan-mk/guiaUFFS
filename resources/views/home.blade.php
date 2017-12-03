@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			<div class="page-header">
				<h1>{{ $section->name }}</h1>
			</div>
			<!-- List group -->
			<ul class="list-group">
				<span>Páginas</span>
				@if(count($pages))
					@foreach($pages as $page)
						<li class="list-group-item">
							<a href="{{ url($page->address) }}">
							@foreach($page->page_versions as $page_version)
								{{ $page_version->title }}
							@endforeach
							</a>
						</li>
					@endforeach
				@else
					<li class="list-group-item">Nenhuma página criada nesta seção.</li>
				@endif
			</ul>
        </div>
    </div>
</div>
@endsection
