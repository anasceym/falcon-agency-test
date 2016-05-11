@extends('layouts.app')

@section('content')

	@include('_partials.page_header')

	<div class="row">
		<div class="col-xs-12 text-right">
			<a href="{{route('admin.books.edit', ['book'=>$book])}}" class="btn btn-primary btn-lg"><i class="fa fa-pencil"></i> &nbsp;Update</a>
			<a href="{{route('admin.books.delete', ['book'=>$book->id])}}" data-csrf-token="{{csrf_token()}}" data-method="delete" class="btn btn-danger btn-lg"><i class="fa fa-remove"></i> &nbsp;Delete</a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12" style="margin-top:25px;">
			<div class="form-group row">
				<div class="col-sm-6">
					<label class="control-label">Title</label>
					<p class="form-control-static">{{ $book->title }}</p>
				</div>
				<div class="col-sm-6">
					<label class="control-label">ISBN Number</label>
					<p class="form-control-static">{{ $book->isbn }}</p>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-6">
					<label class="control-label">Price</label>
					<p class="form-control-static">RM {{ number_format($book->price, 2, '.', ',') }}</p>
				</div>
				<div class="col-sm-6">
					<label class="control-label">Released date</label>
					<p class="form-control-static">{{ $book->released_at->format('m/d/Y') }}</p>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-6">
					<label class="control-label">Book cover</label>
					<img src="{{$book->cover_path}}" class="img-responsive" style="max-height: 150px;" alt=""/>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-xs-12">
							<label class="control-label">Author(s)</label>
							<ol>
								@foreach($book->authors as $author)
									<li>{{ $author->fullname }}</li>
								@endforeach
							</ol>
						</div>
						<div class="col-xs-12">
							<label class="control-label">Genre</label>
							<p class="form-control-static">{{$book->genre->title}}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-12">
					<label class="control-label">Description</label>
					<p class="form-control-static">{{ $book->description }}</p>
				</div>
			</div>
		</div>
	</div>
@endsection