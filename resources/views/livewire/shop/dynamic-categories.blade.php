<div class="w-3/4 p-4 h-screen">
    <h2 class="font-bold text-lg mb-4 text-white">Kategorie</h2>
    <ul class="space-y-2">
        @foreach($categories as $categoryId => $data)
            <li class="relative group">
                <a href="{{ route('shop.categories', $data['category']->name) }}"
                   class="block p-2 btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300 text-white">
                    {{ $data['category']->name }}
                </a>

                @if (count($data['subcategories']) > 0)
                    <ul class="absolute left-full top-0 mt-2 w-48 shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">
                        @foreach($data['subcategories'] as $subcategory)
                            <li>
                                <a href="{{ route('shop.catalog', ['category' => $data['category']->name, 'subCategory' => $subcategory->name]) }}"
                                   class="block p-2 rounded hover:bg-gray-100 text-white">
                                    {{ $subcategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
