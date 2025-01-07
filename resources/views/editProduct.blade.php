@extends('main')

@section('main')
    <div class="flex items-center justify-center  ">
        <div class="bg-gray-900  text-white p-8 rounded-lg w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
            <h1 class="text-xl font-semibold mb-6 text-center">Edytuj wiersz - Tabela: {{ $tableName }}</h1>

            <form action="{{ route('admin.editRowSubmit') }}" method="POST">
                @csrf
                @method('PUT')

                @foreach($row->getAttributes() as $key => $value)
                    @if($key != 'id')
                        <div class="flex items-center mb-3 bg-gray-800 rounded p-2">
                            <label for="{{ $key }}" class="w-1/3 text-white form-label">{{ ucfirst($key) }}</label>
                            <input
                                type="text"
                                name="{{ $key }}"
                                id="{{ $key }}"
                                class="form-control w-2/3 p-2 rounded bg-gray-700 text-white"
                                value="{{ old($key, $value) }}"
                                required
                            >
                        </div>
                    @endif
                @endforeach

                    <button type="submit" class="btn btn-primary w-full mt-4 py-2 bg-blue-800 rounded text-white hover:bg-blue-700">
                        Zapisz
                    </button>
            </form>
        </div>
    </div>
@endsection

