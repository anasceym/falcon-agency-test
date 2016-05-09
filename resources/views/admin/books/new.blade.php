@extends('layout')

@section('content')
	
	@include('_partials.page_header')
	
	<div class="row">
		<div class="col-xs-12">
			<form action="">
				@include('admin.books._partials._form', ['buttonText' => 'Create'])
			</form>
		</div>
	</div>
@endsection