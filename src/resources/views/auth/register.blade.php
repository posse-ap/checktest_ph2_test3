@extends('layouts.admin')

@section('content')
    <div class="w-full mx-auto py-10 px-5">
        <h2 class="text-md font-bold mb-5">サインアップ</h2>
        <label>（登録済みののメールアドレスを入力すると上書きができます。）</label>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label>name</label>
            <input name="name" class="w-full p-4 text-sm mb-3">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
            @enderror
            <label for="email">email</label>
            <input name="email" type="email" placeholder="メールアドレス" class="w-full p-4 text-sm mb-3">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
            @enderror
            <label for="password">password</label>
            <label>パスワードは英数字含む8文字以上 </label>
            <input name="password" type="password" placeholder="パスワード" class="w-full p-4 text-sm mb-3">
            <label>パスワード確認 </label>
            <input id="password-confirm" type="password" class="w-full p-4 text-sm mb-3" name="password_confirmation" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
            @enderror
            <label >githubのID(ない場合は何も書かない)</label>
            <input name="github_id" placeholder="github_id" class="w-full p-4 text-sm mb-3">
            @error('github_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
            @enderror
            <label >slackのID(ない場合は何も書かない)</label>
            <input name="slack_id" placeholder="slack_id" class="w-full p-4 text-sm mb-3">
            @error('slack_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
            @enderror
            <label >role_id(1が一般,2が管理者)</label>
            <input name="role_id" placeholder="1が一般,2が管理者" class="w-full p-4 text-sm mb-4">
            <input type="submit" value="サインアップ" class="cursor-pointer w-full p-3 text-md text-white bg-blue-400 rounded-3xl bg-gradient-to-r from-blue-600 to-blue-300">
        </form>
    </div>
@endsection