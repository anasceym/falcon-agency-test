<?php
namespace App\Transformers;

use App\Author;
use App\Book;
use League\Fractal\TransformerAbstract;

class AuthorTransformer extends TransformerAbstract {

	/**
	 * Books Transformer
	 * @param $article
	 * @return array
	 */
	public function transform(Author $author)
    {
		return [
			'id' => $author->id,
			'fullname' => $author->fullname,
			'email' => $author->email,
			'identity_number' => $author->identity_number
		];
    }
}