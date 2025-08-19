@extends('layouts.app')

@section('title','Contact')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
  <h2 class="page-title">Contact</h2>

  {{-- バリデーションエラー表示（任意） --}}
  @if ($errors->any())
    <div class="alert">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="post" action="{{ route('contact.confirm') }}" class="contact-form" novalidate>
    @csrf

    {{-- お名前 --}}
    <div class="form-row">
      <label class="form-label" for="last_name">お名前 <span class="req">※</span></label>
      <div class="inputs two-cols">
        <input id="last_name" name="last_name" type="text" inputmode="text"
                placeholder="例: 山田" value="{{ old('last_name') }}">
        <input id="first_name" name="first_name" type="text" inputmode="text"
                placeholder="例: 太郎" value="{{ old('first_name') }}">
      </div>
    </div>

    {{-- 性別 --}}
    <div class="form-row">
      <span class="form-label">性別 <span class="req">※</span></span>
      <div class="inputs radios">
        <label><input type="radio" name="gender" value="1" {{ old('gender')==='1' ? 'checked' : '' }}> 男性</label>
        <label><input type="radio" name="gender" value="2" {{ old('gender')==='2' ? 'checked' : '' }}> 女性</label>
        <label><input type="radio" name="gender" value="3" {{ old('gender')==='3' ? 'checked' : '' }}> その他</label>
      </div>
    </div>

    {{-- メールアドレス --}}
    <div class="form-row">
      <label class="form-label" for="email">メールアドレス <span class="req">※</span></label>
      <div class="inputs">
        <input id="email" name="email" type="email" placeholder="例: test@example.com"
                value="{{ old('email') }}">
      </div>
    </div>

    {{-- 電話番号（3 分割） --}}
    <div class="form-row">
      <label class="form-label">電話番号 <span class="req">※</span></label>
      <div class="inputs tel">
        <input name="tel1" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="080" value="{{ old('tel1') }}">
        <span class="sep">-</span>
        <input name="tel2" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="1234" value="{{ old('tel2') }}">
        <span class="sep">-</span>
        <input name="tel3" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="5678" value="{{ old('tel3') }}">
      </div>
    </div>

    {{-- 住所 --}}
    <div class="form-row">
      <label class="form-label" for="address">住所 <span class="req">※</span></label>
      <div class="inputs">
        <input id="address" name="address" type="text" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
      </div>
    </div>

    {{-- 建物名 --}}
    <div class="form-row">
      <label class="form-label" for="building">建物名</label>
      <div class="inputs">
        <input id="building" name="building" type="text" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
      </div>
    </div>

    {{-- お問い合わせ種別 --}}
    <div class="form-row">
      <label class="form-label" for="category_id">お問い合わせの種類 <span class="req">※</span></label>
      <div class="inputs select">
        <select id="category_id" name="category_id">
          @foreach ($categories as $category)
            <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
              {{ $category['content'] }}
            </option>
          @endforeach
        </select>
        <span class="select-caret" aria-hidden="true">▾</span>
      </div>
    </div>

    {{-- お問い合わせ内容 --}}
    <div class="form-row">
      <label class="form-label" for="detail">お問い合わせ内容 <span class="req">※</span></label>
      <div class="inputs">
        <textarea id="detail" name="detail" rows="6" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn-primary">確認画面</button>
    </div>
  </form>
@endsection