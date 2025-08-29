<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // 任意のパスワード
            'role' => 1,       // 管理者
            'is_active' => 1,  // 有効
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
