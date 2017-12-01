@extends('layouts.app')

@section('content')
<div class="container container-sm-narrow">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 great-content">
			<div class="page-header">
				<h1>Sobre o GuiaUFFS</h1>
			</div>
			<p>
				O GuiaUFFS é um guia universitário online e colaborativo.
				Ele foi criado com o objetivo de dar aos estudantes da
				UFFS autonomia no compartilhamento de informações úteis e atualizadas
				referentes à universidade.
			</p>
			<p>
				Aberto à contribuição de qualquer pessoa vinculada à UFFS,
				esperamos que este se torne um espaço ativo e que possa ajudar
				a comunidade acadêmica a conhecer melhor sua instituição de
				ensino e descobrir novas oportunidades.
			</p>
			@guest
				<p>
					Ainda estamos iniciando e precisamos de editores. <a href="{{ route('register') }}">Contribua!</a>
				</p>
			@endguest
        </div>
    </div>
</div>
@endsection
