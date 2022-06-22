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
                            <x-calendar></x-calendar>
                        </div>
                        <div class="w-2/3 py-8 px-5">
                            <h3 class="font-bold text-lg">Mis citas para {{ $date }}</h3>

                            <div class="mt-2 bg-indigo-100 p-3 rounded">
                                <div>Corte de cabello con Jane</div>
                                <div>Desde <span class="font-bold">10:00</span> hasta <span class="font-bold">10:30</span></div>
                            </div>
                            <div class="mt-2 bg-indigo-100 p-3 rounded">
                                <div>Corte de cabello con Jane</div>
                                <div>Desde <span class="font-bold">10:00</span> hasta <span class="font-bold">10:30</span></div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
