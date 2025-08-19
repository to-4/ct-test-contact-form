<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Models\Category;
use App\Models\Contact; // Contact モデルをインポート

class ContactController extends Controller
{

    public function index()
    {

        $categories = Category::all();

        return view('contact.index', compact('categories'));
    }

    public function confirm(StoreContactRequest $request)
    {

        // ここがポイント：配列（string/int/bool等のスカラーのみ）を渡す
        $data = [
            'first_name'  => $request['first_name'] ?? '',
            'last_name'   => $request['last_name'] ?? '',
            'gender'      => $request['gender'] ?? 0,
            'email'       => $request['email'] ?? '',
            'tel1'        => $request['tel1'] ?? '',
            'tel2'        => $request['tel2'] ?? '',
            'tel3'        => $request['tel3'] ?? '',
            'address'     => $request['address'] ?? '',
            'building'    => $request['building'] ?? '',
            'category_id' => $request['category_id'],
            'detail'      => $request['detail'] ?? '',
        ];

        $categoryMap = Category::pluck('content', 'id'); // 変換用
        return view('contact.confirm', compact('data', 'categoryMap'));
     }

    public function send(Request $request)
    {
        // Blade の hidden フォームから受け取る
        $data = $request->all();

        // 電話番号は分割されているので結合してから保存
        $tel = ($data['tel1'] ?? '') . 
               (isset($data['tel2']) ? '-' . $data['tel2'] : '') . 
               (isset($data['tel3']) ? '-' . $data['tel3'] : '');

        // 保存用データを整形
        $saveData = [
            'category_id' => $data['category_id'],
            'first_name'  => $data['first_name'] ?? '',
            'last_name'   => $data['last_name'] ?? '',
            'gender'      => $data['gender'] ?? 0,
            'email'       => $data['email'] ?? '',
            'tel'         => $tel,
            'address'     => $data['address'] ?? '',
            'building'    => $data['building'] ?? '',
            'detail'      => $data['detail'] ?? '',
        ];

        // Contact モデルを介してDB保存

        // (1) モデルのインスタンスを作る（DBにはまだ保存されない）
        // $fillable で許可された属性だけをモデルに代入して インスタンス生成
        $contact = new Contact($saveData);
        // (2) DBに保存する
        $contact->save();

        return redirect()->route('contact.thanks');
    }

    public function thanks()
    {
        return view('contact.thanks'); // 必要なら別途用意
    }
}
