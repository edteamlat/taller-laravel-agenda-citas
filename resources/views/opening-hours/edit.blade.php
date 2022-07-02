<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar horarios de atención') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors></x-auth-validation-errors>
                    @if (session()->has('success'))
                        <div class="p-4 my-2 bg-green-300 border-2 border-green-600 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('opening-hours.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($openingHours as $openingHour)
                                <div>
                                    <x-label for="open[{{ $openingHour->day }}]" value="{{ $openingHour->day_name }}" />

                                    <x-select-time id="open[{{ $openingHour->day }}]" name="open[{{ $openingHour->day }}]" selected-hour='{{ old("open.{$openingHour->day}", $openingHour->open) }}'></x-select-time>
                                    <x-select-time id="close[{{ $openingHour->day }}]" name="close[{{ $openingHour->day }}]" selected-hour='{{ old("close.{$openingHour->day}", $openingHour->close) }}'></x-select-time>
                                </div>
                            @endforeach

                        </div>

                        <x-button class="mt-4">Actualizar</x-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
