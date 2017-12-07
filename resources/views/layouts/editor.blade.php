@extends('layouts.app')

{{-- This could be important in the future --}}

@section('content')
<div class="container container-sm-medium">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			@yield('editor.content')
        </div>
    </div>
</div>
@endsection
