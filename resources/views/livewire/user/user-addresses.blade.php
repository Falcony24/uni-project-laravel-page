<div class=" bg-slate-800 container mx-auto px-4 py-6">
    @if ($addresses->isNotEmpty())
        <h2 class="text-xl font-semibold mb-4">Twoje adresy:</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($addresses as $address)
                <div class="p-4 bg-slate-800 rounded-lg shadow-md text-white">
                    <h3 class="text-lg font-semibold">{{ $address->name }} {{ $address->surname }}</h3>
                    <p>{{ $address->street }} {{ $address->number }}</p>
                    <p>{{ $address->postal_code }} {{ $address->city }}</p>
                    <p>Telefon: {{ $address->phone_number }}</p>
                </div>
            @endforeach

        </div>
    @else
        <p class="text-gray-500 mb-4">Nie masz jeszcze zapisanych adresów.</p>
    @endif

    @if(count($addresses) < 4)
        <div class="p-4 bg-slate-800 rounded-lg shadow-md text-white flex justify-center items-center">
            <button onclick="toggleForm()" class="px-4 py-2 bg-green-800 text-white rounded hover:bg-green-700">Dodaj nowy adres</button>
        </div>
    @endif
</div>
