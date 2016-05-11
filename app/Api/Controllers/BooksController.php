<?php

namespace App\Api\Controllers;

use App\Book;
use App\Transformers\BooksTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
	use Helpers;
	
    public function index(Request $request) {
		
		$paginator = Book::searchAndFilter($request->all())->paginate(10);
		
		return $this->response->paginator($paginator, new BooksTransformer());
	}
}
