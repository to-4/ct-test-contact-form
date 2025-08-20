@extends('layouts.app')  {{-- 親: layouts.app.blade.php --}}

@section('title', 'Register')

{{-- ヒーロー帯（薄ベージュの "Register" 見出し） --}}
@section('page-title')
  Register
@endsection

{{-- ヘッダー右上に「login」リンクを表示（画像どおり） --}}
@section('header_action')
  <!-- <a href="{{ route('login') }}" class="btn-link">login</a> -->
  <a href="{{ route('login') }}"  class="btn-ghost">login</a>
@endsection

{{-- ページ専用CSS --}}
@section('css')
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
  <div class="register-card">
    <form method="POST" action="{{ route('register.post') }}" class="register-form" novalidate>
      @csrf

      {{-- お名前 --}}
      <div class="form-group">
        <label for="name" class="form-label">お名前</label>
        <input id="name" name="name" type="text"
               class="form-input @error('name') is-invalid @enderror"
               value="{{ old('name') }}" placeholder="例: 山田　太郎"
               autocomplete="name">
        @error('name') <p class="form-error">{{ $message }}</p> @enderror
      </div>

      {{-- メールアドレス --}}
      <div class="form-group">
        <label for="email" class="form-label">メールアドレス</label>
        <input id="email" name="email" type="email"
               class="form-input @error('email') is-invalid @enderror"
               value="{{ old('email') }}" placeholder="例: test@example.com"
               autocomplete="email">
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
      </div>

      {{-- パスワード --}}
      <div class="form-group">
        <label for="password" class="form-label">パスワード</label>
        <input id="password" name="password" type="password"
               class="form-input @error('password') is-invalid @enderror"
               placeholder="例: coachtech1106" autocomplete="new-password">
        @error('password') <p class="form-error">{{ $message }}</p> @enderror
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-primary to-home">登録</button>
      </div>
    </form>
  </div>
@endsection
