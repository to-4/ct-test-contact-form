@extends('layouts.app')

@section('title','Thanks')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
  <div class="thanks-wrap">
    <p class="thanks-message">お問い合わせありがとうございました</p>
    <a class="btn-primary to-home" href="{{ route('contact.index') }}">HOME</a>
  </div>
@endsection
