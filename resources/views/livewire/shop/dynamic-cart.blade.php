<div class="w-2/5 flex justify-start items-center">
    @if(!$isAdmin)
        @if ($cartTotal > 0)
            <a href="{{ route('cart') }}" class="hover:underline flex items-center">
                <span class="text-white">Koszyk</span>
                <span class="bg-gray-800 text-white px-2 py-1 rounded">{{ $cartTotal }} zł</span>
            </a>
        @else
            <span class="text-gray-500">Koszyk</span>
        @endif
    @endif
</div>
