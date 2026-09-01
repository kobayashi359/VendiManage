<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company; // ★ 追加

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ★ テスト用のメーカー（会社）データを登録します
        Company::create([
            'company_name' => 'コカ・コーラ',
            'street_address' => '東京都千代田区1-1',
            'representative_name' => '山田太郎',
        ]);

        Company::create([
            'company_name' => 'サントリー',
            'street_address' => '大阪府大阪市1-1',
            'representative_name' => '佐藤花子',
        ]);

        Company::create([
            'company_name' => '伊右衛門',
            'street_address' => '愛知県名古屋市1-1',
            'representative_name' => '鈴木一郎',
        ]);
    }
}