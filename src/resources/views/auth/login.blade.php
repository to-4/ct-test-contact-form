@extends('layouts.app') {{-- 親: layouts.app.blade.php --}}

@section('title', 'Login')

{{-- ページ上部の淡い帯に表示する見出し --}}
@section('page-title')
  Login
@endsection

{{-- ヘッダー右上リンク（画像では「register」） --}}
@section('header_action')
  <!-- <a href="{{ route('register') }}" class="btn-link">register</a> -->
  <a href="{{ route('register') }}"  class="btn-ghost">register</a>
@endsection

{{-- ページ専用CSS --}}
@section('css')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
  <div class="login-card">
    <form action="{{ route('login.post') }}" method="POST" class="login-form" novalidate>
      @csrf

      {{-- メールアドレス --}}
      <div class="form-group">
        <label for="email" class="form-label">メールアドレス</label>
        <input
          id="email"
          name="email"
          type="email"
          class="form-input @error('email') is-invalid @enderror"
          value="{{ old('email') }}"
          placeholder="例: test@example.com"
          autocomplete="email"
        >
        @error('email') <p class="form-error">{{ $message }}</p> @enderror
      </div>

      {{-- パスワード --}}
      <div class="form-group">
        <label for="password" class="form-label">パスワード</label>
        <input
          id="password"
          name="password"
          type="password"
          class="form-input @error('password') is-invalid @enderror"
          placeholder="例: coachtech1106"
          autocomplete="current-password"
        >
        @error('password') <p class="form-error">{{ $message }}</p> @enderror
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-primary to-home">ログイン</button>
      </div>
    </form>
  </div>
@endsection
