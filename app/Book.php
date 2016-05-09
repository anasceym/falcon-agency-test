<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

	/**
	 * Column with date
	 * 
	 * @var array
	 */
	protected $dates = ['released_at'];

	/**
	 * For mass assignment
	 * 
	 * @var array
	 */
	protected $fillable = ['title','isbn', 'description', 'price', 'released_at'];
	
	/**
	 * Relation to App\Author
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function authors() {
		
		return $this->belongsToMany('App\Author');
	}

	/**
	 * Price attribute converted to actual value
	 * 
	 * @param $value
	 * @return float
	 */
	public function getPriceAttribute($value) {
		
		return $value/100;
	}

	/**
	 * Price attribute converted to plain integer instead of double/float
	 * 
	 * @param $value
	 * @return mixed
	 */
	public function setPriceAttribute($value) {
		
		return $value*100;
	}
}
