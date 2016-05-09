@extends('layout')

@section('content')
	
	@include('_partials.page_header')
	
	<div class="row">
		<div class="col-xs-12">
			<form action="{{route('admin.books.update', ['book' => $book->id])}}" method="POST">
				<input type="hidden" name="_method" value="PATCH"/>
				@include('admin.books._partials._form', ['buttonText' => 'Update'])
			</form>
		</div>
	</div>
@endsection