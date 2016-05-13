@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<h1>Books Listing</h1>

			<booklisting
					data-api-authors-url="{{app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('api.authors.index')}}"
					data-api-books-url="{{app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('api.books.index')}}"
					data-api-genres-url="{{app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('api.genres.index')}}"
					data-download-pdf-url="{{route('books.pdf.download')}}"
					></booklisting>
		</div>
	</div>

@endsection