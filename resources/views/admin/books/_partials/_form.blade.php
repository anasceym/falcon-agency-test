<input type="hidden" name="_token" value="{{ csrf_token() }}">

@include('_partials._display_error')

<div class="form-group row">
	<div class="col-sm-6">
		<label class="control-label">Title</label>
		<input class="form-control" name="title" type="text" value="{{  Input::old('title') ? Input::old('title') : $book->title }}"/>
	</div>
	<div class="col-sm-6">
		<label class="control-label">ISBN Number</label>
		<input class="form-control" name="isbn" type="text" value="{{ Input::old('isbn') ? Input::old('isbn') : $book->isbn }}"/>
	</div>
</div>
<div class="form-group row">
	<div class="col-sm-6">
		<label class="control-label">Price</label>
		<input class="form-control" type="text" data-plugin="touchspin" data-prefix="RM" data-steps="50"
			   data-decimals="2" data-min="0" data-max="9999999999" value="{{ Input::old('price') ? Input::old('price') : $book->price }}" name="price" />
	</div>
	<div class="col-sm-6">
		<label class="control-label">Released date</label>
		<input class="form-control" type="text" data-plugin="datepicker" value="{{ Input::old('released_at') ? Input::old('released_at') : $book->released_at ? $book->released_at->format('m/d/Y') : '' }}" name="released_at"/>
	</div>
</div>
<div class="form-group row">
	<div class="col-sm-6">
		<label class="control-label">Book cover</label>
		<input type="file" class="dropify" data-default-file="{{$book->cover_path}}" data-plugin="dropify" name="book_cover"/>
	</div>
	<div class="col-sm-6">
		<div class="row">
			<div class="col-xs-12">
				<label class="control-label">Author(s)</label>
				<select class="selectpicker form-control" data-plugin="multiselect" data-live-search="true" multiple title="Choose author of the following..." name="authors[]">
					  @foreach($authors as $author)
						<option value="{{$author->id}}" {{ in_array($author->id, $book->authors()->get()->lists('id')->toArray() ) ? 'selected' : '' }}>{{$author->first_name}} {{$author->last_name}}</option>
					  @endforeach
				</select>
			</div>
			<div class="col-xs-12" style="margin-top:10px;">
				<label class="control-label">Genre</label>
				<select class="selectpicker form-control" data-plugin="multiselect" data-live-search="true" title="Choose a genre of the following..." name="genre_id">
					  @foreach($genres as $genre)
						<option value="{{$genre->id}}" {{ $book->genre_id == $genre->id ? 'selected' : '' }}>{{$genre->title}}</option>
					  @endforeach
				</select>
			</div>
		</div>
	</div>
</div>
<div class="form-group row">
	<div class="col-sm-12">
		<label class="control-label">Description</label>
		<textarea class="form-control" cols="30" rows="10" name="description"><?php echo $book->description ?></textarea>
	</div>
</div>
<div class="form-group text-right">
	<input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
</div>