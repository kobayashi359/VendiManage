<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::search(
            $request->input('keyword'),
            $request->input('company_id')
        )->get();

        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    public function store(ProductRequest $request)
    {
        // 画像の保存処理
        $imgPath = null;
        if ($request->hasFile('img_path')) {
            $imgPath = $request->file('img_path')->store('products', 'public');
        }

        // ★ Productモデルの createProduct メソッドを呼び出し
        $product = new Product();
        $product->createProduct($request->all(), $imgPath);

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::with('company')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // 画像が送信されている場合のみ保存処理
        $imgPath = null;
        if ($request->hasFile('img_path')) {
            $imgPath = $request->file('img_path')->store('products', 'public');
        }

        // ★ Productモデルの updateProduct メソッドを呼び出し
        $product->updateProduct($request->all(), $imgPath);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}