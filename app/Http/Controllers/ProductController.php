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
        $product = new Product();
        
        // 入力値の代入
        $product->product_name = $request->product_name;
        $product->company_id   = $request->company_id;
        $product->price        = $request->price;
        $product->stock        = $request->stock;
        $product->comment      = $request->comment;
        
        // 画像の保存処理（ランダムなファイル名で保存）
        if ($request->hasFile('img_path')) {
            $dir = 'products';
            $path = $request->file('img_path')->store($dir, 'public');
            $product->img_path = $path; 
        }

        $product->save();

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
       
        // 入力値の更新
        $product->product_name = $request->product_name;
        $product->company_id   = $request->company_id;
        $product->price        = $request->price;
        $product->stock        = $request->stock;
        $product->comment      = $request->comment;

        // 画像が送信されている場合のみ更新
        if ($request->hasFile('img_path')) {
            $dir = 'products';
            $path = $request->file('img_path')->store($dir, 'public');
            $product->img_path = $path;
        }

        $product->save();

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }
}