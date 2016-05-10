@extends('layout')

@section('content')

	@include('_partials.page_header')
	
	<div class="row">
		<div class="col-xs-12 text-right">
			<a href="{{route('admin.books.new')}}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> &nbsp;Create a new book</a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12" style="margin-top:25px;">
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
					<tr>
						<th>ID</th>
						<th>ISBN</th>
						<th>Title</th>
						<th>Released Date</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach($books as $book)
						<tr>
							<td>{{$book->id}}</td>
							<td>{{$book->isbn}}</td>
							<td>{{$book->title}}</td>
							<td>{{$book->released_at->format('d F Y')}}</td>
							<td>
								<a href="{{route('admin.books.show', ['book' => $book->id])}}" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
								<a href="{{route('admin.books.edit', ['book' => $book->id])}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
								<a href="{{ route('admin.books.delete', ['book' => $book->id]) }}" class="btn btn-danger btn-xs" data-csrf-token="{{ csrf_token()  }}" data-confirmation="true" data-method="delete"><i class="fa fa-remove"></i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
					<tfoot>
					<tr>
						<td colspan="5" class="text-right">
							{!! $books->render() !!}
						</td>
					</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
@endsection