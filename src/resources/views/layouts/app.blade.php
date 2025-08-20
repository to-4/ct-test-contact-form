<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
</head>

<body>
  <header class="site-header">
    <div class="container header-wrap">   {{-- 位置指定のためクラスを追加 --}}
      <a class="header__logo" href="/">
        <h1 class="brand">FashionablyLate</h1>
      </a>
      {{-- 右上アクション差し込み（login / register をページ側で切替） --}}
      <div class="header__action">
        @yield('header_action')
      </div>
    </div>
  </header>

  {{-- Register などのページタイトル帯（任意セクションがあれば表示） --}}
  @hasSection('page-title')
    <section class="page-hero">
      <div class="container">
        <h2 class="page-title">@yield('page-title')</h2>
      </div>
    </section>
  @endif

  <main class="container">
    @yield('content')
  </main>

  @yield('scripts')
</body>
</html>
