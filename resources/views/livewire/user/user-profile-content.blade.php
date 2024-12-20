<div>
    <div class="flex text-white p-4 space-x-4 justify-center">
        <button wire:click="loadData('profile')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Dane profilu</button>
        <button wire:click="loadData('addresses')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Adresy</button>
        <button wire:click="loadData('wishList')" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300">Zapisane produkty</button>
    </div>

    <div class="container">
        @if($cotent)
            <h1 class="font-bold">Profil użytkownika</h1>
            <div class="card">
                <div class="card-body">
                        <h5 class="card-title">Imię i nazwisko: {{ $user->name }} {{ $user->surname }}</h5>
                        <p class="card-text">Email: {{ $user->email }}</p>
                        <p class="card-text">Data utworzenia konta: {{ $user->created_at->format('d-m-Y') }}</p>
                </div>
            </div>
        @endif
    </div>
</div>

