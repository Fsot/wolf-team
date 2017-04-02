<?php

namespace wolfteam\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilRequest extends FormRequest
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
            'firstname' => 'alpha|max: 100|min: 2',
            'lastname' => 'max: 100|min: 2|alpha',
            'birthday' => 'date_format:d/m/Y',
            'avatar'    => 'image'
        ];
    }
}
