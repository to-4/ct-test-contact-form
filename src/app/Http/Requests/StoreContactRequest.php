<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 必須（※）
            'last_name'   => ['required','string','max:255'],   // 姓
            'first_name'  => ['required','string','max:255'],   // 名
            'gender'      => ['required'],                      // 性別（実際の値に応じて in: を追加可）
            'email'       => ['required','email:filter','max:255'], // メールアドレス
            'tel1'        => ['required','regex:/^[0-9]{1,5}$/'],   // 電話番号：半角数字・ハイフンなし・最大5桁（要件どおり）
            'tel2'        => ['required','regex:/^[0-9]{1,5}$/'],   // 電話番号：半角数字・ハイフンなし・最大5桁（要件どおり）
            'tel3'        => ['required','regex:/^[0-9]{1,5}$/'],   // 電話番号：半角数字・ハイフンなし・最大5桁（要件どおり）
            'address'     => ['required','string','max:255'],   // 住所
            'category_id' => ['required'],                      // お問い合わせの種類（実際の値に応じて in: か exists: を追加可）
            'detail'      => ['required','string','max:120'],   // お問い合わせ内容（120文字以内）
        ];
    }

    public function messages(): array
    {
        return [
            // 必須メッセージ
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'tel1.required'        => '電話番号(1)を入力してください',
            'tel2.required'        => '電話番号(2)を入力してください',
            'tel3.required'        => '電話番号(3)を入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',

            // 形式・制約
            'email.email'         => 'メールアドレスはメール形式で入力してください',
            // 「半角数字・ハイフンなし・最大5桁」要件に対応（要件どおりの文言）
            'tel1.regex'           => '電話番号(1)は5桁までの数字で入力してください',
            'tel2.regex'           => '電話番号(2)は5桁までの数字で入力してください',
            'tel3.regex'           => '電話番号(3)は5桁までの数字で入力してください',
            // 文字数上限
            'detail.max'          => 'お問合せ内容は120文字以内で入力してください',
        ];
    }

}
