@extends('layouts.app')

@section('content')
<div class="container container-sm-narrow">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			@yield('editor.content')
        </div>
    </div>
</div>
@endsection
