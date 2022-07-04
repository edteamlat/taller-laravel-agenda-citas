<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reagendar cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors></x-auth-validation-errors>
                    <form action="{{ route('staff-scheduler.update', ['scheduler' => $scheduler->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <x-label for="from[date]" :value="__('Fecha para la cita')" />

                                <x-input id="from[date]" class="block mt-1 w-full" type="date" name="from[date]" :value="old('from.date', $scheduler->from->format('Y-m-d'))" autofocus />
                            </div>

                            <div>
                                <x-label for="from[time]" :value="__('Elije la hora de inicio')" />

                                <x-select-time id="from[time]" init-hour="8" end-hour="17" :selected-hour="old('from.time', $scheduler->from->format('H:i'))" class="block mt-1 w-full" name="from[time]"></x-select-time>
                            </div>

                        </div>

                        <x-button class="mt-4">Reagendar</x-button>
                    </form>



                </div>
            </div>
        </div>
    </div>

</x-app-layout>
