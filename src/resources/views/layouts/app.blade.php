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
    <div class="container">
      <a class="header__logo" href="/">
        <h1 class="brand">FashionablyLate</h1>
      </a>
    </div>
  </header>
  <main class="container">
    @yield('content')
  </main>

  @stack('scripts')
</body>
</html>
