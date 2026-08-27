@extends('layouts.app')

@section('content')
<div class="container">
    <h2>商品情報編集画面</h2>

    <!-- エラー表示コード -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id" class="form-label fw-bold">ID</label>
            <input type="text" class="form-control-plaintext" id="id" value="{{ $product->id }}" readonly>
        </div>

        <div class="mb-3">
            <label for="product_name" class="form-label">商品名 <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
        </div>

        <!-- メーカー選択（セレクトボックスに変更） -->
        <div class="mb-3">
            <label for="company_id" class="form-label">メーカー名 <span class="text-danger">*</span></label>
            <select class="form-select" id="company_id" name="company_id" required>
                <option value="">メーカーを選択してください</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">価格 <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">在庫数 <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">コメント</label>
            <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment', $product->comment) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="img_path" class="form-label">商品画像</label>
            <input type="file" class="form-control" id="img_path" name="img_path">
        </div>

        <button type="submit" class="btn btn-warning text-white">更新</button>
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info text-white">戻る</a>
    </form>
</div>
@endsection