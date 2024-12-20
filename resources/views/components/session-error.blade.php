<div>
    @if(session()->has('error'))
        {{session('error')}}
    @endif

    @if(session()->has('success'))
        {{session('success')}}
    @endif
</div>
