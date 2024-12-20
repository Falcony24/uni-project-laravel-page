<div>
    <div class="flex text-white p-4 space-x-4 justify-center">
        <button wire:click="loadForm('products')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Dodaj produkt</button>
        <button wire:click="loadForm('sub_categories')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Dodaj podkategorię</button>
        <button wire:click="loadForm('categories')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Dodaj kategorię</button>
        <button wire:click="loadForm('brands')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Dodaj markę</button>
        <button wire:click="loadImgForm('product_images')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Dodaj obrazy dla produktu</button>
        <button wire:click="loadImgForm('sub_categories_images')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Dodaj obrazy dla podkategorii</button>
    </div>

    <div class="px-4 py-2 bg-slate-950 transition duration-300 rounded">
        @if ($tableName)
            <h3>Formularz dla tabeli: {{ $tableName }}</h3>
            <form wire:submit.prevent="submit">
                @csrf
                @foreach ($formFields as $field)
                    @continue($field == 'id')
                    @if($field == 'images')
                        <div class="flex items-center mb-3 bg-gray-800 rounded p-2">
                            <label for="images" class="w-1/3 text-white form-label">Images</label>
                            <input type="file" multiple id="images" name="images" class="w-2/3 form-control p-2 rounded bg-gray-700 text-white" wire:model.defer="images">
                        </div>
                        <div class="flex items-center mb-3 bg-gray-800 rounded p-2">
                            <label for="{{$tableName}}_id" class="w-1/3 text-white form-label">{{$tableName}}_id</label>
                            <input type="text" id="{{$tableName}}_id" name="{{$tableName}}_id" class="w-2/3 form-control p-2 rounded bg-gray-700 text-white" wire:model.defer="fields.{{$tableName}}_id">
                        </div>
                        @break
                    @endif

                    <div class="flex items-center mb-3 bg-gray-800 rounded p-2">
                        <label for="{{ $field }}" class="w-1/3 text-white form-label">{{ ucfirst($field) }}</label>
                        <input type="text" id="{{ $field }}" name="{{ $field }}" class="w-2/3 form-control p-2 rounded bg-gray-700 text-white" wire:model.defer="fields.{{ $field }}">
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-800 rounded">Zapisz</button>
            </form>
        @else
            <p>Wybierz tabelę, aby załadować formularz.</p>
        @endif
    </div>
</div>
