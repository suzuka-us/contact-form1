<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
   public function rules(): array
{
    return [
        'last_name' => 'required|string|max:50',
        'first_name' => 'required|string|max:50',
        'gender' => 'required|in:male,female,other',
        'email' => 'required|email',
        // telを追加
        'tel_1' => 'required|digits_between:5,11|numeric',
        'tel_2' => 'required|digits_between:5,11|numeric',
        'tel_3' => 'required|digits_between:5,11|numeric',
        'address' => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
        'category_id' => 'nullable|exists:categories,id', // ← required を nullable に変更
        'content' => 'required|string|max:120',
    ];
}

public function messages(): array
{
    return [
        'last_name.required' => '姓を入力してください',
        'first_name.required' => '名を入力してください',
        'gender.required' => '性別を選択してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => 'メールアドレスはメール形式で入力してください',
        'tel.required' => '電話番号を入力してください',
        'tel.digits_between' => '電話番号は5桁までの数字で入力してください',
        'address.required' => '住所を入力してください',
        'content.required' => 'お問い合わせ内容を入力してください',
        'content.max' => 'お問合せ内容は120文字以内で入力してください',
    ];
}

}
