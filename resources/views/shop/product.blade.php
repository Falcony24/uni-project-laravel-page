@extends('main')

@section('links')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endsection

@section('main')
    <div class="container mx-auto mt-6 flex">
        <div class="w-1/3">
            <div class="relative overflow-hidden">
                <div class="flex transition-transform duration-500 ease-in-out" id="slider">
                    @if ($product->productImages->isNotEmpty())
                        @foreach ($product->productImages as $image)
                            <div class="flex-shrink-0 w-full">
                                <img src="{{ asset('storage/' . $product->firstImage->file_path . '/' . $image->file_name) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-auto rounded shadow-lg">
                            </div>
                        @endforeach
                    @else
                        <div class="flex-shrink-0 w-full">
                            <img src="{{ asset('storage/defaultNoImg.png') }}"
                                 alt="No image for this product"
                                 class="w-full h-auto rounded shadow-lg">
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-center space-x-2 mt-4">
                <button id="prev" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300 scale-150">‹</button>
                <button id="next" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300 scale-150">›</button>
            </div>
        </div>

        <div class="w-2/4 ml-6 text-white">
            <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-lg mb-2"><strong>Marka:</strong> {{ $product->brand->name ?? 'Brak informacji' }}</p>
            <p class="text-lg mb-2"><strong>Cena:</strong> {{ $product->price ?? 'Brak informacji' }}</p>
            <p class="mt-6 text-lg"><strong>Opis: </strong>{{ $product->description ?? 'Brak opisu produktu.' }}</p>
        </div>

        <div class="w-1/6 ml-6">
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800 transition duration-300">
                    Dodaj do koszyka
                </button>
            </form>
            @if(Auth::user())
                <form action="{{ route('wishList.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800 transition duration-300">
                        Dodaj do listy życzeń
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection

<script>
    // ZAPAMIETAC JQUERRY TU NIE DZIALA
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.getElementById('slider');
        const slideCount = slides.children.length;
        let currentIndex = 0;

        function updateSlider() {
            const offset = -currentIndex * 100;
            slides.style.transform = `translateX(${offset}%)`;
        }

        const nextButton = document.getElementById('next');
        nextButton.addEventListener('click', function () {
            if (currentIndex < slideCount - 1) {
                currentIndex++;
            } else {
                currentIndex = 0;
            }
            updateSlider();
        });

        const prevButton = document.getElementById('prev');
        prevButton.addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
            } else {
                currentIndex = slideCount - 1;
            }
            updateSlider();
        });
    });
</script>
