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
	protected $fillable = ['title','isbn', 'description', 'price', 'released_at', 'cover_path', 'genre_id', 'show_link'];
	
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
		
		return number_format($value/100, 2, '.', ',');
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

	/**
	 * @param $value
	 */
	public function setReleasedAtAttribute($value) {
		
		try {
			
			$releasedAt = Carbon::createFromFormat('m/d/Y',$value);
			
			$this->attributes['released_at'] = $releasedAt;
			
		} catch(Exception $exp) {
			
			$this->attributes['released_at'] = $value;
		}
		
	}

	/**
	 * @param $value
	 * @return mixed|string
	 */
	public function getCoverPathAttribute($value) {
		
		if($value === '' || $value === null) {
			
			return env('APP_URL').'/images/book-cover.png';
		}
		
		return str_replace('{app_path}',env('APP_URL'),$value);
	}

	/**
	 * @param $request
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */
	public static function searchAndFilter($request) {
		
		$books = self::with(['authors']);
		
		if(isset($request['keyword']) && $request['keyword'] !== '') {
			$books = $books->search($request['keyword']);
		}
		
		if(isset($request['authors']) && is_array($request['authors'])) {
			
			$books = $books->whereHas('authors', function($query) use ($request) {
				
				return $query->whereIn('id', $request['authors']);
			});
		}
		
		if(isset($request['genre']) && $request['genre'] !== 'all') {
			
			$books = $books->where('genre_id', $request['genre']);
		}
		
		if(isset($request['sort'])) {
			
			$books = $books->orderBy($request['sort']['type'], $request['sort']['direction']);
		}
		
		return $books;
	}

	/**
	 * @param $value
	 * @return string
	 */
	public function getExcerptAttribute($value) {
		
		return Str::words($this->attributes['description'], 20);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function genre() {
		
		return $this->belongsTo('App\Genre');
	}

	/**
	 * Get the related books
	 * 
	 * @return mixed
	 */
	public function getRelatedBooksAttribute() {
		
		return self::where('genre_id', $this->attributes['genre_id'])->get();
	}

	/**
	 * Get show book link
	 * 
	 * @param $value
	 */
	public function getShowLinkAttribute($value) {
		
		return route('books.show', ['book' => $this->attributes['id']]);
	}
}
