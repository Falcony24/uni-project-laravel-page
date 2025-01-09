<div>
    <div class="flex text-white p-4 space-x-4 justify-center">
        <button wire:click="loadData('profile')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Dane profilu</button>
        <button wire:click="loadData('addresses')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Adresy</button>
        <button wire:click="loadData('wishList')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Zapisane produkty</button>
    </div>

    <div class="container">
        @if($content)
            <h1 class="font-bold">{{$content['title']}}</h1>
            <div class="card flex flex-col gap-4 items-center">
            @switch($opt)
                    @case('profile')
                        <div class="p-4 bg-slate-800 rounded-lg shadow-md text-white">
                            <p>Imię: {{ $user['name'] }}</p>
                            <p>Nazwisko: {{ $user['surname'] }}</p>
                            <p>Email: {{ $user['email'] }}</p>
                        </div>
                    @break

                    @case('addresses')
                        <livewire:user-addresses/>
                        <div id="addressForm" class="mt-4 p-4 w-96 hidden border border-8 border-slate-950 rounded bg-gray-900">
                            <h3 class="text-lg text-white font-bold mb-4">Dodaj nowy adres</h3>
                            <form action="{{ route('profile.address') }}" method="POST" >
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="block font-semibold">Imię</label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="w-full px-3 py-2 border rounded text-black"
                                        placeholder="Wpisz swoje imię"
                                    >
                                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="surname" class="block font-semibold">Nazwisko</label>
                                    <input
                                        type="text"
                                        id="surname"
                                        name="surname"
                                        class="w-full px-3 py-2 border rounded text-black"
                                        placeholder="Wpisz swoje nazwisko"
                                    >
                                    @error('surname') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="city" class="block font-semibold">Miasto</label>
                                    <input
                                        type="text"
                                        id="city"
                                        name="city"
                                        class="w-full px-3 py-2 border rounded text-black"
                                        placeholder="Wpisz miasto"
                                    >
                                    @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="postal_code" class="block font-semibold">Kod pocztowy</label>
                                    <input
                                        type="text"
                                        id="postal_code"
                                        name="postal_code"
                                        class="w-full px-3 py-2 border rounded text-black"
                                        placeholder="Wpisz kod pocztowy"
                                    >
                                    @error('postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="street" class="block font-semibold">Ulica</label>
                                    <input
                                        type="text"
                                        id="street"
                                        name="street"
                                        class="w-full px-3 py-2 border rounded text-black"
                                        placeholder="Wpisz ulicę"
                                    >
                                    @error('street') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="number" class="block font-semibold">Numer</label>
                                    <input
                                        type="text"
                                        id="number"
                                        name="number"
                                        class="w-full px-3 py-2 border rounded text-black"
                                        placeholder="Wpisz numer domu/mieszkania"
                                    >
                                    @error('number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="phone_number" class="block font-semibold">Numer telefonu</label>
                                    <input
                                        type="text"
                                        id="phone_number"
                                        name="phone_number"
                                        class="w-full px-3 py-2 border rounded text-black"
                                        placeholder="Wpisz numer telefonu"
                                    >
                                    @error('phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="flex flex-col sm:flex-row sm:justify-end sm:space-x-4 space-y-4 sm:space-y-0 mt-4">
                                    <button
                                        type="button"
                                        class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 transition w-full sm:w-auto text-center"
                                        onclick="window.history.back()"
                                    >
                                        Anuluj
                                    </button>
                                    <button
                                        type="submit"
                                        class="bg-green-500 text-black px-4 py-2 rounded hover:bg-green-600 transition w-full sm:w-auto text-center"
                                    >
                                        Zapisz
                                    </button>
                                </div>
                            </form>
                        </div>
                    @break

                    @case('wishList')
                        <div class="space-y-4">
                            @if(count($content['items']) > 0)
                                @foreach($content['items'] as $item)
                                    <div class="flex justify-between items-center p-4 border-b border-gray-300">
                                        <div class="text-gray-800 mx-4">
                                            <a href="{{ route('shop.product', $item['name']) }}" class="text-blue-500 hover:underline">
                                                {{ $item['name'] }}
                                            </a>
                                        </div>
                                        <div class="flex gap-4">
                                            <form method="POST" action="{{ route('cart.add', $item['id']) }}">
                                                @csrf
                                                <button
                                                    wire:click="removeFromWishList('{{ $item['id'] }}')"
                                                    type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                                    Dodaj do koszyka
                                                </button>
                                            </form>
                                            <button
                                                wire:click="removeFromWishList('{{ $item['id'] }}')"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                Usuń z listy życzeń
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Nie posiadasz zapisanego produktu</p>
                            @endif
                        </div>
                    @break
                @endswitch
            </div>
        @endif
    </div>
</div>

<script>
    function toggleForm() {
        var form = document.getElementById('addressForm');

        form.classList.toggle('hidden');
    }
</script>

