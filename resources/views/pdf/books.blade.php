<html>
<head>
	<style>
		table, table th, table td {
			border: 1px solid #eee;
			border-spacing: 0;
			border-collapse: collapse;
		}
		
		th {
			background-color: black;
			color: white;
		}
	</style>
</head>
<body>
<h1>SimpleBookstore</h1>
<h2>Books Listing</h2>
<table class="table table-bordered">
	<thead>
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Description</th>
		<th>Price</th>
	</tr>
	</thead>
	<tbody>
	@foreach($books as $book)
		<tr>
			<td>{{$book->id}}</td>
			<td>{{$book->title}}</td>
			<td>
				<img src="{{$book->cover_path}}" alt="" style="max-height:150px;"/><br/>
				<p><strong>Excerpt : </strong> {{$book->excerpt}}</p>
				<p><strong>ISBN :</strong> {{$book->isbn}}</p>
				<p><strong>Date released : </strong> {{$book->released_at->format('d F Y')}}</p>
				
				<p><strong>Author(s) : </strong>
					<ol>
						@foreach($book->authors as $author)
							<li>{{$author->fullname}}</li>
						@endforeach
					</ol>
				</p>
			</td>
			<td>RM{{$book->price}}</td>
		</tr>
	@endforeach
	</tbody>
</table>
</body>
</html>