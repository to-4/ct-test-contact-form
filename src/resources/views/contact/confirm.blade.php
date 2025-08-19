@extends('layouts.app')

@section('title','Confirm')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection


@section('content')
  <h2 class="page-title">Confirm</h2>

  {{-- 送信用フォーム（hidden で全項目を引き継ぐ） --}}
  <form method="post" action="{{ route('contact.send') }}" class="confirm-form">
    @csrf
    @foreach ($data as $k => $v)
      @if(is_array($v))
        @foreach($v as $kk => $vv)
          <input type="hidden" name="{{ $k.'['.$kk.']' }}" value="{{ $vv }}">
        @endforeach
      @else
        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
      @endif
    @endforeach

    <div class="confirm-table">
      <div class="row">
        <div class="th">お名前</div>
        <div class="td">{{ $data['last_name'] ?? '' }} {{ $data['first_name'] ?? '' }}</div>
      </div>
      <div class="row">
        <div class="th">性別</div>
        <div class="td">
          @php
            $g = $data['gender'] ?? '';
            $gmap = [
              1 => '男性',
              2 => '女性',
              3 => 'その他',
            ];
          @endphp
          {{ $gmap[$g] ?? '' }}
        </div>
      </div>
      <div class="row">
        <div class="th">メールアドレス</div>
        <div class="td">{{ $data['email'] ?? '' }}</div>
      </div>
      <div class="row">
        <div class="th">電話番号</div>
        <div class="td">{{ ($data['tel1']??'').($data['tel2']||$data['tel3']?'-':'') }}{{ $data['tel2']??'' }}{{ isset($data['tel3'])?'-'.$data['tel3']:'' }}</div>
      </div>
      <div class="row">
        <div class="th">住所</div>
        <div class="td">{{ $data['address'] ?? '' }}</div>
      </div>
      <div class="row">
        <div class="th">建物名</div>
        <div class="td">{{ $data['building'] ?? '' }}</div>
      </div>
      <div class="row">
        <div class="th">お問い合わせの種類</div>
        <div class="td">
          @php
            $t = $data['category_id'] ?? '';
          @endphp
          {{ $categoryMap[$t] ?? '' }}
        </div>
      </div>
      <div class="row">
        <div class="th">お問い合わせ内容</div>
        <div class="td pre">{{ $data['detail'] ?? '' }}</div>
      </div>
    </div>

    <div class="actions">
      <button type="submit" class="btn-primary">送信</button>
      <button type="button" class="btn-link" onclick="history.back()">修正</button>
    </div>
  </form>
@endsection
