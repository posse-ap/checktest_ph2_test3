@extends('layouts.app')

@section('content')
    <main class="bg-gray-100 h-screen">
        <div class="w-full mx-auto py-10 px-5">
        <h2 class="text-md font-bold mb-5">ログイン</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">email</label>
            <input id="email" type="email" placeholder="メールアドレス" class="w-full p-4 text-sm mb-3 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
            @enderror
            <label for="password">password</label>
            <input id="password" type="password" placeholder="パスワード" class="w-full p-4 text-sm mb-3 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
            @enderror
            <input type="submit" value="ログイン" class="cursor-pointer w-full p-3 text-md text-white bg-blue-400 rounded-3xl bg-gradient-to-r from-blue-600 to-blue-300">
        </form>
        @if (Route::has('password.request'))
            <div class="text-center text-xs text-gray-400 mt-6">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        @endif
        </div>
    </main>
    </body>

    </html>
@endsection