<input type="hidden" name="_token" value="{{ csrf_token() }}">

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
	<div class="col-sm-12">
		<label class="control-label">Description</label>
		<textarea class="form-control" cols="30" rows="10" name="description"><?php echo $book->description ?></textarea>
	</div>
</div>
<div class="form-group text-right">
	<input type="submit" class="btn btn-success" value="{{$buttonText}}"/>
</div>