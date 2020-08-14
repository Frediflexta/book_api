<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
        return [
            'name' => 'filled|string',
            'author' => 'filled|string',
            'isbn' => 'filled|string',
            'number_of_pages' => 'filled|integer',
            'publisher' => 'filled|string',
            'country' => 'filled|string',
            'release_date' => 'filled|string'
        ];
    }
}
