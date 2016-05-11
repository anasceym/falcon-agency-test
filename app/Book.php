<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \Exception;
use Illuminate\Support\Str;
use Sofa\Eloquence\Eloquence;

class Book extends Model
{
	use Eloquence;
	
	/**
     * Searchable rules.
     *
     * @var array
     */
     protected $searchableColumns = ['title', 'description'];
	
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
	protected $fillable = ['title','isbn', 'description', 'price', 'released_at', 'cover_path'];
	
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
		
		$this->attributes['price'] = $value*100;
	}
	
	public function setReleasedAtAttribute($value) {
		
		try {
			
			$releasedAt = Carbon::createFromFormat('m/d/Y',$value);
			
			$this->attributes['released_at'] = $releasedAt;
			
		} catch(Exception $exp) {
			
			$this->attributes['released_at'] = $value;
		}
		
	}
	
	public function getCoverPathAttribute($value) {
		
		return str_replace('{app_path}',env('APP_URL'),$value);
	}
	
	public static function searchAndFilter($request) {
		
		$books = self::with(['authors']);
		
		if(isset($request['keyword']) && $request['keyword'] !== '') {
			$books = $books->search($request['keyword']);
		}
		
		if(isset($request['filter']['author'])) {
			
		}
		
		return $books;
	}
	
	public function getExcerptAttribute($value) {
		
		return Str::words($this->attributes['description'], 20);
	}
}
