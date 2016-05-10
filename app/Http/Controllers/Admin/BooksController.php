<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Book;
use App\Http\Requests\BookRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Flash;
use Image;

class BooksController extends Controller
{
    /**
	 * Handle the books listing
	 * 
	 * @return string
	 */
	public function index() {
		
		$books = Book::latest()->paginate(10);
		
		return view('admin.books.index', compact('books'));
	}

	/**
	 * Handle the new book form
	 * 
	 * @return string
	 */
	public function create() {
		
		$book = new Book();
		$authors = Author::all();
		
		return view('admin.books.new', compact('book', 'authors'));
	}

	/**
	 * Handle show the update form
	 * 
	 * @param Book $book
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit(Book $book) {
		
		$authors = Author::all();
		
		return view('admin.books.edit', compact('book', 'authors'));
	}

	/**
	 * Method to handle update book
	 * 
	 * @param Request $request
	 * @param Book $book
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(BookRequest $request, Book $book) {
		
		$data = $request->all();
		
		$data = $this->handleUploadCover($request, $data);
		
		$book->authors()->sync($data['authors']);
		$book->update($data);
		
		Flash::success('Successfully updated information for '. $book->title);
		
		return redirect()->route('admin.books.index');
	}

	/**
	 * Method to handle the create Book process
	 * 
	 * @param BookRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function handleCreate(BookRequest $request) {
		
		$data = $request->all();

		$data = $this->handleUploadCover($request, $data);

		if($book = Book::create($data)) {
			
			$book->authors()->sync($data['authors']);
			
			Flash::success('Successfully added book '.$book->title);
		}
		else {
			
			Flash::error('Failed to create the book. Please try again');
		}
		
		return redirect()->route('admin.books.index');
	}

	/**
	 * Method to handle delete the Book
	 * 
	 * @param Book $book
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function destroy(Book $book) {
		
		$bookTitle = $book->title;
		
		if($book->delete()) {
			
			Flash::success('Successfully deleted book '.$bookTitle);
		}
		else {
			
			Flash::error('Failed to delete book '.$bookTitle);
		}
		
		return redirect()->back();
	}

	/**
	 * @param BookRequest $request
	 * @param $data
	 * @return mixed
	 */
	private function handleUploadCover(BookRequest $request, $data)
	{
		if ($request->hasFile('book_cover')) {

			$file = $request->file('book_cover');

			if (preg_match('/^image\/(png|jpg|jpeg|bmp)/', $file->getClientMimeType())) {

				$fileName = 'book-cover-' . time() . '.' . $file->getClientOriginalExtension();

				$fullPath = 'images/uploaded/' . $fileName;

				$image = Image::make($file);
				$image->fit(600, 600);
				$image->save($fullPath);

				$data['cover_path'] = '{app_path}/' . $fullPath;
				return $data;
			}
			return $data;
		}
		return $data;
	}
}
