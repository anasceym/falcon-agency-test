<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Flash;

class BooksController extends Controller
{
    /**
	 * Handle the books listing
	 * 
	 * @return string
	 */
	public function index() {
		
		$books = Book::paginate(10);
		
		return view('admin.books.index', compact('books'));
	}

	/**
	 * Handle the new book form
	 * 
	 * @return string
	 */
	public function create() {
		
		$book = new Book();
		
		return view('admin.books.new', compact('book'));
	}

	/**
	 * Handle show the update form
	 * 
	 * @param Book $book
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Book $book) {
		
		return view('admin.books.edit', compact('book'));
	}
	
	public function update(Request $request, Book $book) {
		
		$data = $request->get('book');
		
		
		$releasedAt = Carbon::createFromFormat('m/d/Y',$data['released_at']);
		
		if($releasedAt) {
			
			$book->released_at = $releasedAt;
		}
		
		unset($data['released_at']);
		
		$book->update($data);
		
		Flash::success('Successfully updated information for '. $book->title);
		
		return redirect()->route('admin.books.index');
	}
}
