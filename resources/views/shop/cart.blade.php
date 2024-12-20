@extends('main')

@section('main')
    <div class="container">
        @if (count($cartItems) == 0)
            <p>Twój koszyk jest pusty.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Cena</th>
                    <th>Ilość</th>
                    <th>Razem</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price'], 2) }} zł</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['total'], 2) }} zł</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h3>Łączna kwota: {{ number_format($cartTotal, 2) }} zł</h3>
        @endif
    </div>
@endsection
