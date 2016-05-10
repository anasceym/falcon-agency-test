<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group row">
	<div class="col-sm-6">
		<label class="control-label">Title</label>
		<input class="form-control" name="book[title]" type="text" value="{{$book->title}}"/>
	</div>
	<div class="col-sm-6">
		<label class="control-label">ISBN Number</label>
		<input class="form-control" name="book[isbn]" type="text" value="{{$book->isbn}}"/>
	</div>
</div>
<div class="form-group row">
	<div class="col-sm-6">
		<label class="control-label">Price</label>
		<input class="form-control" type="text" data-plugin="touchspin" data-prefix="RM" data-steps="50"
			   data-decimals="2" data-min="0" data-max="9999999999" value="{{$book->price}}" name="book[price]" />
	</div>
	<div class="col-sm-6">
		<label class="control-label">Released date</label>
		<input class="form-control" type="text" data-plugin="datepicker" value="{{ $book->released_at ? $book->released_at->format('m/d/Y') : '' }}" name="book[released_at]"/>
	</div>
</div>
<div class="form-group row">
	<div class="col-sm-12">
		<label class="control-label">Description</label>
		<textarea class="form-control" cols="30" rows="10" name="book[description]">
		</textarea>
	</div>
</div>
<div class="form-group text-right">
	<input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
</div>