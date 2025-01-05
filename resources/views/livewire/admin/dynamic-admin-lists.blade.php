<div>
    <div class="flex text-white p-4 space-x-4 justify-center">
        <button wire:click="loadList('users')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Tabela użytkowników</button>
        <button wire:click="loadList('products')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Tabela produktów</button>
        <button wire:click="loadList('categories')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Tabela kategorii</button>
        <button wire:click="loadList('sub_categories')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Tabela podkategorii</button>
        <button wire:click="loadList('brands')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Tabela marek</button>
        <button wire:click="loadList('orders')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Tabela zamówień</button>
        <button wire:click="loadList('product_images')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Tabela zdjęć produktów</button>
    </div>

    <div class="px-4 py-2 bg-slate-950 transition duration-300 rounded">
        @if($tableName)
            <h3 class="text-white">Dane z tabeli: {{ $tableName }}</h3>
            <div class="overflow-x-auto">
                <table class="w-full bg-gray-700 text-white border-collapse border border-gray-600">
                    <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th class="border border-gray-500 px-2 py-1">{{ $column }}</th>
                        @endforeach
                        <th class="border border-gray-500 px-2 py-1">Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            @foreach($columns as $column)
                                <td class="border border-gray-500 px-2 py-1">{{ $row->$column }}</td>
                            @endforeach
                            <td>
{{--                                <form action="{{ route('editRow', ['id' => $row->id]) }}" method="POST" style="display: inline;">--}}
{{--                                    @csrf--}}
{{--                                    @method('PUT')--}}
{{--                                    <button type="submit" class="bg-green-500 px-2 py-1 rounded">Edytuj</button>--}}
{{--                                </form>--}}
                                <form action="{{ route('admin.deleteRow')}}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="tableName" value="{{ $tableName }}">
                                    <input type="hidden" name="id" value="{{ $row->id }}">
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 px-2 py-1 rounded">Usuń</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-300">Wybierz tabelę, aby załadować dane.</p>
        @endif
    </div>
</div>
