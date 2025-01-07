@extends('shop.shopMain')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>
        <form id="filtersForm" class="p-4 bg-slate-700 rounded mb-6 text-white">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <label for="price_min" class="block text-sm font-semibold">Cena od:</label>
                    <input
                        type="number"
                        id="price_min"
                        name="price_min"
                        class="w-full px-4 py-2 bg-gray-700 text-white rounded"
                        placeholder="Min"
                        wire:model.defer="priceMin"
                    >
                </div>

                <div>
                    <label for="price_max" class="block text-sm font-semibold">Cena do:</label>
                    <input
                        type="number"
                        id="price_max"
                        name="price_max"
                        class="w-full px-4 py-2 bg-gray-700 text-white rounded"
                        placeholder="Max"
                        wire:model.defer="priceMax"
                    >
                </div>
            </div>

            <button
                type="button"
                id="applyFilters"
                class="mt-4 px-4 py-2 bg-green-800 hover:bg-green-700 rounded text-white"
                wire:click="a"
            >
                Zastosuj filtry
            </button>
        </form>

        <livewire:dynamic-products :sub-category-name="$title" />
    </div>
@endsection
