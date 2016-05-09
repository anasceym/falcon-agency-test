<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
	/**
	 * Relation to App\Book
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function books() {
		
		return $this->belongsToMany('App\Book');
	}
}
