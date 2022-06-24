@props([
    'disabled' => false,
    'initHour' => 0,
    'endHour' => 23,
    'selectedHour' => '',
])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
    <option>--Selecciona la hora--</option>
    @foreach (range($initHour, $endHour) as $hour)
        @php
            $formatedHour = str_pad($hour, 2, '0', STR_PAD_LEFT);
        @endphp

        <option value="{{ $formatedHour.":00" }}" {{ "{$formatedHour}:00" == $selectedHour ? 'selected' : '' }}>
            {{ "{$formatedHour}:00" }}
        </option>
        <option value="{{ $formatedHour.":30" }}" {{ "{$formatedHour}:30" == $selectedHour ? 'selected' : '' }}>
            {{ "{$formatedHour}:30" }}
        </option>
    @endforeach
</select>
