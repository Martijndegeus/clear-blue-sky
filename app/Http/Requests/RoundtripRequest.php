<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoundtripRequest extends FormRequest
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
            'origin'           => ['required', 'string', 'max:3'],
            'destination'      => ['required', 'string', 'max:3'],
            'departure'        => ['required', 'string'],
            'arrival'          => ['required', 'string'],
            'number_of_adults' => ['required', 'numeric', 'min:1'],
            'cabin'            => ['nullable', 'string'],
            'layovers'         => ['required', 'numeric', 'min:0'],
        ];
    }
}
