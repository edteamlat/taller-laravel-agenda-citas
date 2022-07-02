<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpeningHour extends Model
{
    use HasFactory;

    protected $dayNames = [
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
        7 => 'Domingo',
    ];

    protected function open(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return date('H:i', strtotime($value));
            }
        );
    }

    protected function close(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return date('H:i', strtotime($value));
            }
        );
    }

    protected function dayName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return $this->dayNames[$attributes['day']];
            }
        );
    }
}
