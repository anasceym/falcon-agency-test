<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

use App\Http\Requests;
use PDF;

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
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function downloadPdf(Request $request) {
		
		$books = Book::searchAndFilter($request->all())->get();
		
		$pdf = PDF::loadView('pdf.books', compact('books'));
		return $pdf->download('simplebookstore-books-listing.pdf');
	}

	/**
	 * Method to show a book
	 * 
	 */
	public function show(Book $book) {
		
		return view('books.show', compact('book'));
	}
}
