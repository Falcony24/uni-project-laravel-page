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
                            <td class="py-4 px-6 text-white">
                                <a href="{{ route('shop.product', $item['name']) }}">{{ $item['name'] }}</a>
                            </td>
                            <td class="py-4 px-6 text-white">{{ number_format($item['price'], 2) }} zł</td>
                            <td class="py-4 px-6 text-black">
                                @if ($canEdit)
                                    <input
                                        type="number"
                                        min="1"
                                        value="{{ $item['quantity'] }}"
                                        wire:model.defer="cartItems.{{ $loop->index }}.quantity"
                                        wire:change="updateQuantity({{ $item['product_id'] }}, $event.target.value)"
                                        class="w-16 text-center border rounded px-2 py-1"
                                    >
                                @else
                                    <span class="text-white">{{ $item['quantity'] }}</span>
                                @endif
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

        @if ($canEdit)
            <div class="mt-6 text-right">
                <button wire:click="lockCart" class="btn btn-primary px-4 py-2 bg-blue-800 text-white rounded">
                    Przejdź dalej
                </button>
            </div>
        @else
            <div class="bg-slate-800 container mx-auto px-4 py-6">
                @if ($addresses->isNotEmpty())
                    <h2 class="text-xl font-semibold mb-4">Twoje adresy:</h2>
                    <form action="" method="POST" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @csrf
                        @foreach($addresses as $address)
                            <label for="address_{{ $address->id }}" class="p-4 bg-slate-800 rounded-lg shadow-md text-white cursor-pointer">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $address->name }} {{ $address->surname }}</h3>
                                    <p>{{ $address->street }} {{ $address->number }}</p>
                                    <p>{{ $address->postal_code }} {{ $address->city }}</p>
                                    <p>Telefon: {{ $address->phone_number }}</p>
                                </div>
                                <input
                                    type="radio"
                                    name="selected_address"
                                    value="{{ $address->id }}"
                                    id="address_{{ $address->id }}"
                                    class="mt-2"
                                    required
                                >
                            </label>
                        @endforeach

                        <div class="col-span-full flex justify-center mt-6">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-green-800 text-white rounded hover:bg-green-700"
                            >
                                Zamów
                            </button>
                        </div>
                    </form>
                @else
                    <p class="text-gray-500 mb-4">Nie masz jeszcze zapisanych adresów, wejdź w zakładkę adresy, która znajduje się na twoim profilu</p>
                @endif
            </div>
        @endif
    @endif
</div>

<script>
    function toggleForm() {
        var form = document.getElementById('addressForm');

        form.classList.toggle('hidden');
    }
</script>
