<div>
    <div class="flex text-white p-4 space-x-4 justify-center">
        <button wire:click="loadData('profile')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Dane profilu</button>
        <button wire:click="loadData('addresses')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Adresy</button>
        <button wire:click="loadData('wishList')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Zapisane produkty</button>
    </div>

    <div class="container">
        @if($content)
            <h1 class="font-bold">{{$content['title']}}</h1>
            <div class="card">
{{--                <pre>{{ print_r($content['items'], true) }}</pre>--}}

            @switch($opt)
                    @case('profile')
                            <p>Imię: {{ $user['name'] }}</p>
                            <p>Nazwisko: {{ $user['surname'] }}</p>
                            <p>Email: {{ $user['email'] }}</p>
                    @break

                    @case('addresses')
                    @break

                    @case('wishList')
                        <div class="space-y-4">
                            @foreach($content['items'] as $item)
                                <div  class="flex justify-between items-center p-4 border-b border-gray-300">
                                    <div class="text-gray-800">
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
                        </div>

                    @break
                @endswitch
            </div>
        @endif
    </div>
</div>

