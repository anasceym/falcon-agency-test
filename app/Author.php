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
	
	public function getFullnameAttribute($value) {
		
		return $this->attributes['first_name'].' '.$this->attributes['last_name'];
	}
}
