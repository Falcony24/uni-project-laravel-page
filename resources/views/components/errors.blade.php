<div class="w-1/2">
    @if (session('success'))
        <div class="text-green-500">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="text-red-500">{{ session('error') }}</div>
    @endif
</div>
