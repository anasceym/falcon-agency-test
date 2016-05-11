<?php

namespace App\Api\Controllers;

use App\Author;
use App\Transformers\AuthorTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthorsController extends Controller
{
	use Helpers;

	/**
	 * Method that return the lists of Authors
	 * 
	 * @return \Dingo\Api\Http\Response
	 */
	public function index() {
		
		return $this->response->collection(Author::all(), new AuthorTransformer());
	}
}
