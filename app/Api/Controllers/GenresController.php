<?php

namespace App\Api\Controllers;

use App\Genre;
use App\Transformers\GenreTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GenresController extends Controller
{
	use Helpers;

	/**
	 * Get all genres
	 * 
	 */
	public function index() {
		
		$genres = Genre::all();
		
		return $this->response->collection($genres, new GenreTransformer());	
	}
}
