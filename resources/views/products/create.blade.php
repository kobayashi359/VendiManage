@extends('layouts.app')

@section('content')
<div class="container">
    <h2>商品新規登録画面</h2>

    {{-- 1. エラーメッセージ表示エリア --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 2. フォーム領域（1つにまとめました） --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品名 --}}
        <div class="mb-3">
            <label for="product_name" class="form-label">商品名 <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}">
        </div>

        {{-- メーカー名 --}}
        <div class="mb-3">
            <label for="company_id" class="form-label">メーカー名 <span class="text-danger">*</span></label>
            <select class="form-select" id="company_id" name="company_id">
                <option value="">メーカーを選択してください</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- 価格 --}}
        <div class="mb-3">
            <label for="price" class="form-label">価格 <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div>

        {{-- 在庫数 --}}
        <div class="mb-3">
            <label for="stock" class="form-label">在庫数 <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
        </div>

        {{-- コメント --}}
        <div class="mb-3">
            <label for="comment" class="form-label">コメント</label>
            <textarea class="form-control" id="comment" name="comment">{{ old('comment') }}</textarea>
        </div>

        {{-- 商品画像 --}}
        <div class="mb-3">
            <label for="img_path" class="form-label">商品画像</label>
            <input type="file" class="form-control" id="img_path" name="img_path">
        </div>

        {{-- ボタン領域 --}}
        <button type="submit" class="btn btn-warning text-white">新規登録</button>
        <a href="{{ route('products.index') }}" class="btn btn-info text-white">戻る</a>
    </form>
</div>
@endsection