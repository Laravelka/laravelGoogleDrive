@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 mb-5">
		<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('Панель управления') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ route('admin.users') }}">{{ __('Пользователи') }}</a></li>
					<li class="breadcrumb-item"><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">{{ $user->name }}</a></li>
					<li class="breadcrumb-item active" aria-current="page">Договора</li>
				</ol>
			</nav>
			<div class="card">
				<ul class="list-group list-group-flush">
					...
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection
