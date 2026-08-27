<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company; // ★ Company モデルをインポート
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    // クエリビルダの準備（リレーションを含める）
    $query = Product::with('company');

    // 商品名で検索（あいまい検索）
    if ($keyword = $request->input('keyword')) {
        $query->where('product_name', 'LIKE', "%{$keyword}%");
    }

    // メーカーIDで絞り込み
    if ($companyId = $request->input('company_id')) {
        $query->where('company_id', $companyId);
    }

    // 商品一覧とメーカー一覧を取得
    $products = $query->get();
    $companies = Company::all();

    return view('products.index', compact('products', 'companies'));
}

    public function create()
    {
        $companies = Company::all(); // 新規作成画面用
        return view('products.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'company_id'   => 'required',
            'price'        => 'required|integer',
            'stock'        => 'required|integer',
            'comment'      => 'nullable',
            'img_path'     => 'nullable|image|max:2048',
        ]);

        $img_path = null;
        if ($request->hasFile('img_path')) {
            $filename = $request->file('img_path')->getClientOriginalName();
            $img_path = $request->file('img_path')->storeAs('products', $filename, 'public');
        }

        Product::create([
            'product_name' => $request->product_name,
            'company_id'   => $request->company_id, // ★ company_name から company_id に修正
            'price'        => $request->price,
            'stock'        => $request->stock,
            'comment'      => $request->comment,
            'img_path'     => $img_path,
        ]);

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all(); // ★ セレクトボックス用にメーカー一覧を取得
        return view('products.edit', compact('product', 'companies'));
    }

    public function update(Request $request, $id)
    {
        // 1. バリデーション
        $request->validate([
            'product_name' => 'required',
            'company_id'   => 'required',
            'price'        => 'required|integer',
            'stock'        => 'required|integer',
        ]);

        // 2. 更新対象データの取得
        $product = Product::findOrFail($id);

        // 3. 画像の保存処理（アップロードされた場合）
        if ($request->hasFile('img_path')) {
            $filename = $request->file('img_path')->getClientOriginalName();
            $img_path = $request->file('img_path')->storeAs('products', $filename, 'public');
            $product->img_path = $img_path;
        }

        // 4. データの更新
        $product->product_name = $request->product_name;
        $product->company_id   = $request->company_id;
        $product->price        = $request->price;
        $product->stock        = $request->stock;
        $product->comment      = $request->comment;
        $product->save();

        // 5. 一覧画面へリダイレクト
        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}