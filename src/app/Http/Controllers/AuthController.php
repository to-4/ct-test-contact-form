<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

class AuthController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }

    public function store(StoreUserRequest $request)
    {
        // 検証はここへ来る前に完了（$request->validated() でOK）
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            // 必要なら管理画面用フラグやロール付与など
            // 'is_admin' => true,
        ]);

        // そのままログインさせたい場合
        Auth::login($user);

        // 管理画面へ
        return redirect()->intended(route('admin')); // 好きな遷移先に
    }

    public function login()
    {
        return view('auth.login');
    }

    public function send(LoginRequest $request)
    {
        $credentials = $request->validated();

        // remember チェックボックスがあれば第二引数で制御
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin')); // 成功→管理画面へ
        }

        // ここでは「認証失敗」を email フィールドのエラーとして返す（項目下に出せる）
        throw ValidationException::withMessages([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function admin(Request $request)
    {
        $query = Contact::query()->with('category');

        if ($kw = trim($request->keyword ?? '')) {
            $query->where(function ($q) use ($kw) {
                $q->where('first_name', 'like', "%{$kw}%")
                ->orWhere('last_name', 'like', "%{$kw}%")
                ->orWhere('email', 'like', "%{$kw}%");
            });
        }
        if ($request->filled('gender'))   $query->where('gender', $request->gender);
        if ($request->filled('category')) $query->where('category_id', $request->category);
        if ($request->filled('date')) {
            $date = $request->date;
            $query->whereBetween('created_at', ["{$date} 00:00:00", "{$date} 23:59:59"]);
        }

        $contacts = $query->latest()
                            ->paginate(10)
                            ->withQueryString();   // これで ?keyword=... などを自動的に引き継ぐ

        $categoryMap = Category::orderBy('id')->pluck('content', 'id')->toArray();

        return view('auth.admin', compact('contacts','categoryMap'));
    }

    public function delete(Request $request, Contact $contact)
    {

        $contact->delete();           // 物理削除（ソフトデリートなら ->forceDelete() しない）

        // 検索条件とページ番号を引き継いで一覧へ戻る
        $keep = Arr::only($request->query(), ['keyword','gender','category','date','page']);

        return redirect()
            ->route('admin', $keep)
            ->with('status', '1件削除しました。');
    }
}
