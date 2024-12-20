@extends('shop.shopMain')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($subCategories as $subCategory)
                <div class="border rounded-lg shadow p-4">
                    <a href="{{route('shop.catalog', [$title, $subCategory->name])}}">
                        <h2 class="text-lg font-semibold">{{ $subCategory->name }}</h2>
                        @foreach ($subCategory->subCategoryImages as $image)
                            <img src="{{ asset('storage/' . $image->file_path . '/' . $image->file_name) }}"
                                 alt="Zdjęcie podkategorii"
                                 class="w-full h-auto rounded shadow-lg">
                        @endforeach
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
