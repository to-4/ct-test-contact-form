@extends('layouts.app')

@section('title','Admin')

{{-- ページタイトル帯 --}}
@section('page-title')
  Admin
@endsection

{{-- ヘッダー右上（ログアウト） --}}
@section('header_action')
  <form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <!-- <button type="submit" class="btn-link">logout</button> -->
    <button type="submit" class="btn-ghost">logout</button>
  </form>
@endsection

{{-- ページ専用CSS --}}
@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

  @if(session('status'))
    <div class="alert">{{ session('status') }}</div>
  @endif

  {{-- 検索フォーム --}}
  <form action="{{ route('admin') }}" method="GET" class="search-form">
    {{-- 名前 / メール --}}
    <!-- <input type="text" name="keyword" value="{{ $filters['keyword'] ?? '' }}" 
           placeholder="名前やメールアドレスを入力してください" class="search-input"> -->
    <input type="text" name="keyword"
           value="{{ request('keyword', '') }}"
           placeholder="名前やメールアドレスを入力してください" class="search-input">

    {{-- 性別 --}}
    @php
      // バリデーション後は old()、それ以外はクエリ文字列 ?gender=...
      $gender = (string) old('gender', request()->query('gender', ''));
    @endphp
    <select name="gender" class="search-select">
      <option value="">性別</option>
      <option value="1" {{ $gender === '1'  ? 'selected' : '' }}>男性</option>
      <option value="2" {{ $gender === '2'  ? 'selected' : '' }}>女性</option>
      <option value="3" {{ $gender === '3'  ? 'selected' : '' }}>その他</option>
    </select>

    {{-- カテゴリ --}}
    <select name="category" class="search-select">
      <option value="">お問い合わせの種類</option>
      @foreach($categoryMap as $id => $label)
        <option value="{{ $id }}" {{ (string)request('category')===(string)$id ? 'selected' : '' }}>
          {{ $label }}
        </option>
      @endforeach
    </select>

    {{-- 日付 --}}
    <input type="date" name="date" value="{{ request('date') }}" class="search-select">

    <button type="submit" class="btn-primary">検索</button>
    <a href="{{ route('admin') }}" class="btn-reset">リセット</a>
  </form>

  <!-- {{-- エクスポートボタン --}}
  <div class="export">
    <button type="button" class="btn-reset">エクスポート</button>
  </div> -->

  {{-- エクスポート + ページネーション を同じ行に --}}
  <div class="toolbar">
    <div class="toolbar__left">
      <button type="button" class="btn-reset" onclick="alert('エクスポートは未実装です');">エクスポート</button>
    </div>

    <div class="toolbar__right">
      {{-- ▼ 後述の「カスタムページネーションビュー」を使って描画 --}}
      {{ $contacts->withQueryString()->links('auth.vendor.pagination.admin') }}
    </div>
  </div>

  {{-- 一覧テーブル --}}
  <table class="admin-table">
    <thead>
      <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせの種類</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($contacts as $contact)
        <tr>
          <td>{{ $contact->last_name . " " . $contact->first_name }}</td>
          <td>
            @if($contact->gender == 1) 男性
            @elseif($contact->gender == 2) 女性
            @else その他
            @endif
          </td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->category->content ?? '' }}</td>
          <td>
            <!-- JavaSript で dataset オブジェクトで参照するためカスタム属性使用（HTML5から有効） -->
            <button type="button"
                    class="btn-detail"
                    data-id="{{ $contact->id }}"
                    data-name="{{ $contact->last_name . ' ' . $contact->first_name }}"
                    data-gender="{{ $contact->gender }}"
                    data-email="{{ $contact->email }}"
                    data-tel="{{ $contact->tel }}"
                    data-address="{{ $contact->address }}"
                    data-building="{{ $contact->building }}"
                    data-category="{{ $contact->category->content ?? '' }}"
                    data-content="{{ $contact->detail }}">
              詳細
            </button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5">該当するデータがありません</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <!-- {{-- ページネーション --}}
  <div class="pagination">
    {{ $contacts->links() }}
  </div> -->

{{-- モーダル --}}
<div id="detailModal" class="modal hidden">
  <div class="modal-content">
    <button class="modal-close">&times;</button>
    <table class="detail-table">
      <tr><th>お名前</th><td id="m-name"></td></tr>
      <tr><th>性別</th><td id="m-gender"></td></tr>
      <tr><th>メールアドレス</th><td id="m-email"></td></tr>
      <tr><th>電話番号</th><td id="m-tel"></td></tr>
      <tr><th>住所</th><td id="m-address"></td></tr>
      <tr><th>建物名</th><td id="m-building"></td></tr>
      <tr><th>お問い合わせの種類</th><td id="m-category"></td></tr>
      <tr><th>お問い合わせ内容</th><td id="m-content"></td></tr>
    </table>
    <form id="deleteForm" method="POST">
      @csrf
      @method('DELETE')

      {{-- 検索条件保持（必要に応じて） --}}
      <input type="hidden" name="keyword" value="{{ request('keyword') }}">
      <input type="hidden" name="gender"  value="{{ request('gender') }}">
      <input type="hidden" name="category" value="{{ request('category') }}">
      <input type="hidden" name="date" value="{{ request('date') }}">
      <input type="hidden" name="page" value="{{ request('page') }}">

      <button type="submit" class="btn-danger">削除</button>
    </form>
  </div>
</div>
<!-- モーダル本体 -->
<div id="helloModal" class="modal hidden">
  <div class="modal-content">
    <button class="modal-close">&times;</button>
    <p>Hello</p>
  </div>
</div>
@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const modal     = document.getElementById('detailModal');
  const closeBtn  = modal?.querySelector('.modal-close');
  const deleteForm = document.getElementById('deleteForm');
  const body      = document.body;

  // ルートヘルパを使って URL テンプレートを生成（:id を後で差し替える）
  const destroyUrlTemplate = @json(route('admin.delete', ':id'));

  // ユーティリティ
  const openModal = () => { modal.classList.remove('hidden'); body.style.overflow = 'hidden'; };
  const closeModal = () => { modal.classList.add('hidden'); body.style.overflow = ''; };

  // 「詳細」ボタン → モーダル展開
  document.querySelectorAll('.btn-detail').forEach(btn => {
    btn.addEventListener('click', () => {

      // 値の差し込み
      document.getElementById('m-name').textContent     = btn.dataset.name ?? '';
      document.getElementById('m-gender').textContent   =
        btn.dataset.gender == 1 ? '男性' : (btn.dataset.gender == 2 ? '女性' : 'その他');
      document.getElementById('m-email').textContent    = btn.dataset.email ?? '';
      document.getElementById('m-tel').textContent      = btn.dataset.tel ?? '';
      document.getElementById('m-address').textContent  = btn.dataset.address ?? '';
      document.getElementById('m-building').textContent = btn.dataset.building ?? '';
      document.getElementById('m-category').textContent = btn.dataset.category ?? '';
      document.getElementById('m-content').textContent  = btn.dataset.content ?? '';

      // 削除フォームの action を選択行の ID で差し替え
      deleteForm.action = destroyUrlTemplate.replace(':id', btn.dataset.id);

      openModal();
      // モーダル内の最初のボタンにフォーカス
      setTimeout(() => deleteForm.querySelector('button[type="submit"]')?.focus(), 0);
    });
  });

  // 閉じる（×ボタン、背景クリック、Esc キー）
  closeBtn?.addEventListener('click', closeModal);
  modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', (e) => {
    if (!modal.classList.contains('hidden') && e.key === 'Escape') closeModal();
  });

  // 削除の確認（誤操作防止）
  deleteForm.addEventListener('submit', (e) => {
    const ok = confirm('この問い合わせを削除します。よろしいですか？');
    if (!ok) { e.preventDefault(); return; }
    // 連打防止
    deleteForm.querySelector('button[type="submit"]')?.setAttribute('disabled', 'disabled');
  });
});


</script>
@endsection

