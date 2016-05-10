<?php

namespace App\Http\Requests;

use App\Book;
use App\Http\Requests\Request;

class BookRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		switch($this->method()) {
			case 'PATCH':
			case'PUT':
				return [
					'title' => 'required',
					'isbn' => 'required|unique:books,isbn,'.$this->route('book')->id,
					'price' => 'required',
					'released_at' => 'required|date_format:m/d/Y'
				];
				break;
		}
		
        return [
            'title' => 'required',
        	'isbn' => 'required|unique:books,isbn,260',
			'price' => 'required',
			'released_at' => 'required|date_format:m/d/Y'
        ];
    }
}
