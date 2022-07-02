<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpeningHourRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'open' => 'required|array',
            'open.1' => 'required|before:close.1',
            'open.2' => 'required|before:close.2',
            'open.3' => 'required|before:close.3',
            'open.4' => 'required|before:close.4',
            'open.5' => 'required|before:close.5',
            'open.6' => 'required|before:close.6',
            'close.1' => 'required',
            'close.2' => 'required',
            'close.3' => 'required',
            'close.4' => 'required',
            'close.5' => 'required',
            'close.6' => 'required',
        ];
    }
}
