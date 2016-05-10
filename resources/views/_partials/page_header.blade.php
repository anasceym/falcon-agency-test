<div class="row">
	<div class="col-xs-12">
		<h1>Books</h1>
		
		<?php  $routeName = Route::current()->getName() ?>
		@if(Breadcrumbs::exists($routeName))
			
			@if($routeName === 'admin.books.edit' || $routeName === 'admin.books.show')
				{!! Breadcrumbs::render(Route::current()->getName(), $book) !!}
			@else
				{!! Breadcrumbs::render(Route::current()->getName()) !!}
			@endif
		@endif
	</div>
</div>