<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // ★ 重複を全て削除し、これ1つだけにまとめます
    protected $fillable = [
        'company_name',
    ];
}