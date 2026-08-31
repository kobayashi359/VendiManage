<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'street_address',
        'representative_name',
    ];

    // ★ Productモデルとのリレーション（1対多）を追加
    public function products()
    {
        return $this->hasMany(Product::class);
    }
} // ← 最後の波カッコを忘れずに閉じます