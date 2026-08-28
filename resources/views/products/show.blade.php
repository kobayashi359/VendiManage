@extends('layouts.app')

@section('content')
<div class="container">
    <h2>商品詳細画面</h2>

    <div class="mb-3">
    <label class="fw-bold">ID:</label>
    <p>{{ $product->id }}</p>
</div>

    <div class="mb-3">
        <label class="fw-bold">商品画像:</label>
        <div>
            @if($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" width="200">
            @else
                <p>画像はありません。</p>
            @endif
        </div>
    </div>

    <div class="mb-3">
        <label class="fw-bold">商品名:</label>
        <p>{{ $product->product_name }}</p>
    </div>

    <div class="mb-3">
        <label class="fw-bold">メーカー名:</label>
        <p>{{ $product->company->company_name ?? '' }}</p>
    </div>

    <div class="mb-3">
        <label class="fw-bold">価格:</label>
        <p>￥{{ number_format($product->price) }}</p>
    </div>

    <div class="mb-3">
        <label class="fw-bold">在庫数:</label>
        <p>{{ $product->stock }}</p>
    </div>

    <div class="mb-3">
        <label class="fw-bold">コメント:</label>
        <p>{{ $product->comment }}</p>
    </div>

   <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning text-white">編集</a>
    <a href="{{ route('home') }}" class="btn btn-info text-white">戻る</a>
</div>
@endsection
