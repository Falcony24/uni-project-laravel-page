@extends("main")

@section("links")
    <script src="js/formView.js"></script>
@endsection

@section("main")
    <div id="formContainer" class="px-4 py-2 bg-slate-950 transition duration-300 rounded justify-self-center text-white mt-5">
        <div class="text-center mb-4">
            <button id="loginBtn" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300" onclick="showLoginForm()">Logowanie</button>
            <button id="registerBtn" class="btn btn-info px-4 py-2 bg-blue-800 hover:bg-blue-600 rounded transition duration-300" onclick="showRegisterForm()">Rejestracja</button>
            <br>
            @if ($errors->any())
                <div class="alert alert-danger text-red-800">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div id="formLogin">
            <form method="POST" action="{{ route('login.post') }}" style="display:flex; justify-content: center; flex-direction: column; align-items: center">
                <span class="font-semibold">Logowanie</span>
                @csrf
                <div class="flex items-center mb-3 bg-gray-800 rounded p-2 min-w-96">
                    <label for="email" class="w-1/3 text-white form-label">Email</label>
                    <input type="email" placeholder="Email" id="email" name="email" class="w-2/3 form-control p-2 rounded bg-gray-700 text-white" required autofocus>
                </div>

                <div class="flex items-center mb-3 bg-gray-800 rounded p-2 min-w-96">
                    <label for="password" class="w-1/3 text-white form-label">Hasło</label>
                    <input type="password" placeholder="Hasło" id="password" class="w-2/3 form-control p-2 rounded bg-gray-700 text-white" name="password" required>
                </div>

                <div >
                    <button type="submit" class="btn btn-dark btn-block bg-green-500 px-2 py-1 rounded">Zaloguj</button>
                </div>
            </form>
        </div>

        <div id="formRegister" class="hidden">
            <form method="POST" action="{{ route('register.post') }}" style="display:flex; justify-content: center; flex-direction: column; align-items: center" class="min-w-80">
                <span class="font-semibold">Rejestracja</span>
                @csrf
                <div class="flex items-center mb-3 bg-gray-800 rounded p-2 min-w-96">
                    <label for="name" class="w-1/3 text-white form-label text-nowrap">Imię i nazwisko</label>
                    <input type="text" placeholder="Imię i Nazwisko" id="name" name="name" class="w-2/3 form-control p-2 rounded bg-gray-700 text-white" required autofocus>
                </div>

                <div class="flex items-center mb-3 bg-gray-800 rounded p-2 min-w-96">
                    <label for="email" class="w-1/3 text-white form-label">Email</label>
                    <input type="email" placeholder="Email" id="email" name="email" class="w-2/3 form-control p-2 rounded bg-gray-700 text-white" required>
                </div>

                <div class="flex items-center mb-3 bg-gray-800 rounded p-2 min-w-96">
                    <label for="password" class="w-1/3 text-white form-label">Hasło</label>
                    <input type="password" placeholder="Hasło" id="password" name="password" class="w-2/3 form-control p-2 rounded bg-gray-700 text-white" required minlength="6" maxlength="32">
                </div>

                <div class="flex items-center mb-3 bg-gray-800 rounded p-2 min-w-96">
                    <label for="password_confirmation" class="w-1/3 text-white form-label">Powtórz hasło</label>
                    <input type="password" placeholder="Powtórz hasło" id="password_confirmation" name="password_confirmation" class="w-2/3 form-control p-2 rounded bg-gray-700 text-white" required>
                </div>

                <div class="d-grid mx-auto">
                    <button type="submit" class="btn btn-dark btn-block bg-green-500 px-2 py-1 rounded">Zarejestruj</button>
                </div>
            </form>
        </div>
    </div>
@endsection
