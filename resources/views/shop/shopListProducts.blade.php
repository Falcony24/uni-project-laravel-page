@extends('shop.shopMain')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>
        <livewire:dynamic-products :sub-category-name="$title" />
    </div>
@endsection
