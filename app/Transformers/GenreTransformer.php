<?php
namespace App\Transformers;

use App\Genre;
use League\Fractal\TransformerAbstract;

class GenreTransformer extends TransformerAbstract {

	/**
	 * Books Transformer
	 * @param $article
	 * @return array
	 */
	public function transform(Genre $genre)
    {
		return [
			'id' => $genre->id,
			'title' => $genre->title,
			'description' => $genre->description
		];
    }
}