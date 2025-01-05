<div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @if (count($products) !== 0)
            @foreach ($products as $product)
                <a href="{{ route('shop.product', $product->name) }}">
                    <div class="border rounded p-4 shadow hover:shadow-lg">
                        <h2 class="font-bold text-lg">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $product->description }}</p>
                        <p class="mt-2 font-semibold">Cena: {{ $product->price }} zł</p>
                    </div>
                </a>
            @endforeach
        @else
            <p>Brak produktów w tej kategorii</p>
        @endif
    </div>

    @if (count($products) >= $perPage)
        <button wire:click="loadMore"
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Pokaż więcej
        </button>
    @endif
</div>
