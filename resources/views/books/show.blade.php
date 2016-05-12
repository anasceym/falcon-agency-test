@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<h1>Book details</h1>

			<div class="row">
				<div class="col-sm-6">
					<img src="{{$book->cover_path}}" class="img-responsive thumbnail" alt=""/>
				</div>
				<div class="col-sm-6 text-right">
					<a href="#" class="btn btn-success btn-lg"><i class="fa fa-money"></i>&nbsp;&nbsp;BUY</a><br/>
					<share
							data-fb-app-id="{{env('FB_APP_ID')}}" 
							data-share="{{ $book->toJson()  }}" ></share>
				</div>
			</div>
			<hr/>
			<h2>{{$book->title}}</h2>

			<p>{{$book->description}}</p>

			<div class="row">
				<div class="col-sm-4">
					<h4>Author(s)</h4>
					<ol>
						@foreach($book->authors as $author)
							<li>{{$author->fullname}}</li>
						@endforeach
					</ol>
				</div>
				<div class="col-sm-4">
					<h4>ISBN</h4>

					<p>RM{{$book->isbn}}</p>
					<h4>Released date</h4>

					<p>{{$book->released_at->format('d F Y')}}</p>
					
					<h4>Genre</h4>

					<p>{{$book->genre->title }}</p>
				</div>
				<div class="col-sm-4">
					<h4>Price</h4>

					<p>RM{{$book->price}}</p>
				</div>
			</div>
			<hr/>
		</div>
		@if($book->related_books->count())
			<div class="col-xs-12">
				<h3>Related books</h3>

				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

					<div class="carousel-inner" role="listbox">
						@foreach($book->related_books as $key => $related_book)
							
							<div class="item {{ $key == 0 ? 'active' : '' }}">
								<img src="{{$related_book->cover_path}}" class="img-responsive center-block" alt="...">
	
								<div class="carousel-caption" style="background: rgba(0,0,0,0.65); padding-left: 20px; padding-right: 20px;">
									<h3><a href="{{route('books.show', ['book' => $book])}}">{{$related_book->title}}</a></h3>
									<p>{{$related_book->excerpt}}</p>
								</div>
							</div>
						@endforeach
					</div>

				</div>
			</div>
		@endif
	</div>

@endsection