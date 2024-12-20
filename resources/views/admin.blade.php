@extends('main')

@section('main')
    <div class="flex">
        <div class="w-1/2 bg-gray-800 text-white p-4 ">
            <livewire:dynami-admin-forms />
        </div>
        <div class="w-1/2 bg-gray-800 text-white p-4 ">
            <livewire:dynamic-admin-lists />
        </div>
    </div>
@endsection
