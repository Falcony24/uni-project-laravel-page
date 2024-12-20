<div class="text-white relative group w-2/5 flex items-center justify-end right">
    @if ($isAdmin)
        <div class="cursor-pointer flex">
            <div class="w-2/3">
                <a href="{{ route('admin.index') }}">
                    <span class="hover:underline">Profil Opcje</span>
                </a>
            </div>
            <div id="dropdown-menu" class="absolute hidden bg-gray-800 p-4 rounded shadow-lg mt-14">
                <div class="hover:underline">
                    <a href="{{ route('admin.index') }}">Panel administracyjny</a>
                </div>
                <div class="hover:underline">
                    <button wire:click="logout">Wyloguj</button>
                </div>
            </div>
        </div>
    @elseif ($isUser)
        <div class="cursor-pointer flex">
            <div class="w-2/3">
                <a href="{{ route('profile.index') }}">
                    <span class="hover:underline">Profil Opcje</span>
                </a>
            </div>
            <div id="dropdown-menu" class="absolute hidden bg-gray-800 p-4 rounded shadow-lg mt-14">
                <div class="hover:underline">
                    <a href="{{ route('profile.index') }}">Profil</a>
                </div>
                <div class="hover:underline">
                    <a href="{{ route('profile.wishList') }}">Lista życzeń</a>
                </div>
                <div class="hover:underline">
                    <button wire:click="logout">Wyloguj</button>
                </div>
            </div>
        </div>
    @else
        <div>
            <div class="w-1/3">
                <a href="{{ route('login.view') }}" class="hover:underline">
                    Logowanie <br> Rejestracja
                </a>
            </div>
        </div>
    @endif
</div>
