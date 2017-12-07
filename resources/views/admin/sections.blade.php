@extends('layouts.admin')

@section('admin.content')
	<div class="page-header">
		<h1>Seções</h1>
	</div>
	<ul class="list-group no-margins">
		@include('admin.recursive_section', ['sections' => $sections])
	</ul>
@endsection
