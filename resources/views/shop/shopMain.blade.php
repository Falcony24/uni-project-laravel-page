@extends("main")

@section("main")
    <div class="flex">
        <div class="w-1/4 h-1">
            <livewire:dynamic-categories/>
        </div>

        <div class="w-3/5 p-4 text-white">
            @yield('content')
        </div>
    </div>
@endsection
