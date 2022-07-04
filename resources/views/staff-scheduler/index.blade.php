<x-app-layout>
    <x-slot name="headers">
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi agenda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <div class="flex bg-gray-300">
                        <div class="w-1/3">
                            <x-calendar url-handler="{{ route('staff-scheduler.index') }}"></x-calendar>
                        </div>
                        <div class="w-2/3 py-8 px-5">
                            <h3 class="font-bold text-lg">Mis citas para: {{ $date->isoFormat('dddd Do MMMM YYYY') }}</h3>
                            <x-auth-validation-errors></x-auth-validation-errors>
                            @foreach ($dayScheduler as $schedule)
                                <div class="flex items-center mt-2 bg-indigo-100 p-3 rounded">
                                    <div class="w-1/2">
                                        <div>{{ $schedule->service->name }} a {{ $schedule->clientUser->name }}</div>
                                        <div>Desde <span class="font-bold">{{ $schedule->from->format('H:i') }}</span> hasta <span class="font-bold">{{ $schedule->to->format('H:i') }}</span></div>
                                    </div>
                                    <div>
                                        <form method="POST" onsubmit="return confirm('¿Realmente deseas cancelar esta cita?')" action="{{ route('staff-scheduler.destroy', ['scheduler' => $schedule->id]) }}" class="inline-block">
                                            @method('DELETE')
                                            @csrf
                                            <x-button :disabled="auth()->user()->cannot('delete', $schedule)">Cancelar</x-button>
                                        </form>
                                        <x-link :disabled="auth()->user()->cannot('update', $schedule)" href="{{ route('staff-scheduler.edit', ['scheduler' => $schedule->id]) }}">
                                            Reagendar
                                        </x-link>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
