<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Str;   
use Illuminate\Validation\ValidationException;       

class UpdatePostRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if ($this->url_clean === null)
            $url_clean = Str::slug($this->title) ;
        else {
            $url_clean = Str::slug($this->url_clean) ;
        }
        $this->merge([ 'url_clean' => $url_clean ]);
    }
    function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $response = new Response($validator->errors(), 422);
            throw new ValidationException($validator, $response);
        }
    }
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
        return[
            'title' => 'required|min:5|max:500',
            'url_clean' => 'max:500|unique:posts,url_clean,'.$this->route("post")->id,
            'content' => 'required|min:5',
            'category_id' => 'required',
            'posted' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:102400',
            'tags' => []
        ];
    }
}
