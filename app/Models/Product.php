<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'company_id',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeSearch($query, $keyword, $companyId)
    {
        $query->with('company');

        if ($keyword) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }

        if ($companyId) {
            $query->where('company_id', $companyId);
        }

        return $query;
    }

    public function createProduct($data, $imgPath = null)
    {
        return $this->create([
            'product_name' => $data['product_name'],
            'company_id'   => $data['company_id'],
            'price'        => $data['price'],
            'stock'        => $data['stock'],
            'comment'      => $data['comment'] ?? null,
            'img_path'     => $imgPath,
        ]);
    }

    public function updateProduct($data, $imgPath = null)
    {
        $this->product_name = $data['product_name'];
        $this->company_id   = $data['company_id'];
        $this->price        = $data['price'];
        $this->stock        = $data['stock'];
        $this->comment      = $data['comment'] ?? null;
        if ($imgPath) {
            $this->img_path = $imgPath;
        }
        return $this->save();
    }
}