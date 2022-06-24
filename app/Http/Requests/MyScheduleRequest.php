<?php

namespace App\Http\Requests;

use App\Business\StaffServiceChecker;
use App\Business\StaffAvailabilityChecker;
use App\Business\ClientAvailabilityChecker;
use Illuminate\Foundation\Http\FormRequest;

class MyScheduleRequest extends FormRequest
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
            'from.date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'from.time' => 'required|date_format:H:i',
            'staff_user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ];
    }

    public function checkReservationRules($staffUser, $clientUser, $from, $to, $service)
    {
        if (!(new StaffAvailabilityChecker($staffUser, $from, $to))
            ->check()) {
            abort(back()->withErrors('Este horario no está disponible.')->withInput());
        }

        if (!(new ClientAvailabilityChecker($clientUser, $from, $to))
            ->check()) {
            abort(back()->withErrors('Ya tienes una reservación en este horario.')->withInput());
        }

        if (!(new StaffServiceChecker($staffUser, $service))
            ->check()) {
            abort(back()->withErrors("{$staffUser->name} no presta el servicio de {$service->name}.")->withInput());
        }
    }
}
