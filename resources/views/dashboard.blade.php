<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a href="{{ route('ultrasound.create') }}" class="btn btn-primary">ثبت اطلاعات سونوگرافی</a>
 

    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
    <div id="app">
    <example-component></example-component>
</div>
@vite('resources/js/app.js')

</x-app-layout>
