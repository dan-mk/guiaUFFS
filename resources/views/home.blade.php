@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			<div class="page-header">
				<h1>{{ $section->name }}</h1>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<!-- List group -->
					<div class="list-group list-group-pages">
						@if(count($pages))
							@foreach($pages as $page)
								<a class="list-group-item" href="{{ url($page->address) }}">
									{{ $page->page_versions->first()->title }}
								</a>
							@endforeach
						@else
							<li class="list-group-item">Nenhuma página criada nesta seção.</li>
						@endif
					</div>
				</div>
				<div class="col-sm-4">
					<!-- List group -->
					<span class="bottom-margin">Seções relacionadas</span>
					<nav>
						@if($section_parent != null || count($section_children))

							@if($section_parent != null)
								<a class="btn btn-link btn-link-vertical-menu" href="{{ route('main.home') }}">
									{{ $section_parent->name }}
								</a>
							@endif

							@foreach($section_children as $section_child)
								<a class="btn btn-link btn-link-vertical-menu" href="{{ route('home', $section_child->subdomain) }}">
									{{ $section_child->name }}
								</a>
							@endforeach
						@else
							<li class="list-group-item">Nenhuma seção relacionada.</li>
						@endif
					</nav>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
