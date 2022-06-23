@props([
    'disabled' => false,
    'initHour' => 0,
    'endHour' => 23,
    'selectedHour' => '',
])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
    <option>--Selecciona la hora--</option>
    @foreach (range($initHour, $endHour) as $hour)
        <option value="{{ "{$initHour}:00" }}" {{ "{$initHour}:00" == $selectedHour ? 'selected' : '' }}>
            {{ "{$hour}:00" }}
        </option>
        <option value="{{ "{$initHour}:30" }}" {{ "{$initHour}:30" == $selectedHour ? 'selected' : '' }}>
            {{ "{$hour}:30" }}
        </option>
    @endforeach
</select>
