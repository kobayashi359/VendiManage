<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
{
    return [
        'product_name' => 'required|max:255',
        'company_id'   => 'required|exists:companies,id',
        'price'        => 'required|integer|min:0',
        'stock'        => 'required|integer|min:0',
        'comment'      => 'nullable|max:1000',
        // ★ 画像のバリデーションルールを追加します
        'img_path'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
}
}