<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

use App\Http\Requests;

class BooksController extends Controller
{
	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(Request $request) {
		
		return view('books.index');
	}

	/**
	 * Method to show a book
	 * 
	 */
	public function show(Book $book) {
		
		return view('books.show', compact('book'));
	}
}
