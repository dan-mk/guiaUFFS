@extends('layouts.admin')

@section('admin.content')
	@include('admin.recursive_section', ['sections' => $sections])
@endsection
