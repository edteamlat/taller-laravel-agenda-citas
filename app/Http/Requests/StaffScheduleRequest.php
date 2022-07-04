<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffScheduleRequest extends FormRequest
{
    use ManagesReservationRules;

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
            'from.date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'from.time' => 'required|date_format:H:i',
        ];
    }
}
