<?php
namespace App\Transformers;

use App\Book;
use League\Fractal\TransformerAbstract;

class BooksTransformer extends TransformerAbstract {
	
	/**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'authors'
    ];
	
	/**
	 * Books Transformer
	 * @param $article
	 * @return array
	 */
	public function transform(Book $book)
    {
		return [
			'id' => $book->id,
			'title' => $book->title,
			'excerpt' => $book->excerpt,
			'price' => $book->price,
			'cover_path' => $book->cover_path,
			'released_at' => $book->released_at->format('d F Y'),
			'show_link' => $book->show_link
		];
    }
	
	/**
     * Include Author
     *
     * @param Book $book
     * @return \League\Fractal\Resource\Item
     */
    public function includeAuthors(Book $book)
    {
        $authors = $book->authors;

        return $this->collection($authors, new AuthorTransformer);
    }
}