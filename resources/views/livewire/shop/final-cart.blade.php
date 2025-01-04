    <div class="container mx-auto px-4 py-6 ">
        @if (count($cartItems) == 0)
            <p class="text-center text-lg font-semibold text-white">Twój koszyk jest pusty.</p>
        @else
            <div class="overflow-x-auto shadow-lg rounded-lg border border-slate-700 ">
                <table class="min-w-full bg-slate-950 ">
                    <thead class="bg-slate-950 border-b-2 border-slate-700 hover:bg-slate-800">
                    <tr>
                        <th class="py-3 px-6 text-left text-white">Produkt</th>
                        <th class="py-3 px-6 text-left text-white">Cena</th>
                        <th class="py-3 px-6 text-left text-white">Ilość</th>
                        <th class="py-3 px-6 text-left text-white">Razem</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cartItems as $item)
                        <tr class="border-b-2 border-slate-700 hover:bg-slate-800">
                            <td class="py-4 px-6 text-white"><a href="{{ route('shop.product', $item['name']) }}">{{ $item['name'] }}</a></td>
                            <td class="py-4 px-6 text-white">{{ number_format($item['price'], 2) }} zł</td>
                        <td class="py-4 px-6 text-black">
                            <input
                                type="number"
                                min="1"
                                value="{{ $item['quantity'] }}"
                                wire:model="cartItems.{{ $loop->index }}.quantity"
                                wire:change="updateQuantity({{ $item['product_id'] }}, $event.target.value)"
                                class="w-16 text-center border rounded px-2 py-1"
                            >
                        </td>
                        <td class="py-4 px-6 text-white">{{ number_format($item['total'], 2) }} zł</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-right">
            <h3 class="text-xl font-semibold text-white">Łączna kwota: {{ number_format($cartTotal, 2) }} zł</h3>
        </div>
    @endif
</div>
